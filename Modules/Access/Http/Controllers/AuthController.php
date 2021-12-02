<?php

namespace Modules\Access\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Modules\Admin\Entities\EmailVerification;
use Modules\Admin\Entities\ResetPassword;
use Modules\Access\Entities\User;
use Modules\Access\Entities\Invitation;
use Carbon\Carbon;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function credentials(Request $request)
    {
        return ['email' => $request->{$this->username()}, 'password' => $request->password, 'confirmed' => 1];
    }

    public function destroy() {
        // Logout the user
        auth()->logout();
        return redirect()->route('login');
    }

    public function getRegister() {
        // Load the register blade
        return view('admin::admin.register');
    }

    public function checkEmail(Request $request) {

        $registered_email_1 = Email::where('email', $request->email)->first();

        $registered_email_2 = User::where('email', $request->email)->first();

        if($registered_email_1 === null){
            return back()->withInput()->withErrors(['unexpected_error' => trans('translate.the_email_doesnt_exist') ]);
        } else if($registered_email_2 != null) {
            return back()->withInput()->withErrors(['unexpected_error' => trans('translate.the_email_already_registered') ]);
        } else {
            $email = $registered_email_1->email;

            return view('access::auth.invitation_register', compact('email'));
        }

    }

    // Create new user and store in DB (password hash, email sending)
    public function store(Request $request) {

        $validatedData = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'terms_conditions' => 'required'
        ]);

        $invitation = Invitation::where('email',$validatedData['email'])->first();

        // If user register with invitation
        if($invitation != null) {
            $validatedData['confirmed'] = 1;
            $validatedData['password'] = bcrypt($request['password']);

            $user = User::create($validatedData);
            $user->assignRole('user');

            $invitation->registered_at = \Carbon\Carbon::now();
            $invitation->save();

            $description = 'User ' . $user->firstname . ' ' . $user->lastname .' registered with invitation link.';
            $props = ['email' => $user->email, 'is_admin' => $user->is_admin];

            ActionLog::create('user', $description, $props);

        } else {
            $validatedData['confirmed'] = 0;
            $validatedData['password'] = bcrypt($request['password']);

            $confirmation_code = Str::random(30);
            $validatedData['confirmation_code'] = $confirmation_code;

            $user = User::create($validatedData);
            $user->assignRole('user');

            \Mail::to($validatedData['email'])->send(new EmailVerification($user, $confirmation_code));

            $description = 'User ' . $user->firstname . ' ' . $user->lastname .' registered  without invitation link.';
            $props = ['email' => $user->email, 'is_admin' => $user->is_admin];

            ActionLog::create('user', $description, $props);
        }
        return view('access::auth.register_result', compact('user'));
        //return redirect()->route('login')->with('success_message', trans('translate.registered_successfully') );
    }

    // E-mail verification
    public function confirm($confirmation_code)
    {
        $user = User::where('confirmation_code', $confirmation_code)->first();

        if($user) {
            $user->update([
                'confirmed' => 1,
                'confirmation_code' => null
            ]);

            $description = 'User '. $user->firstname . ' ' . $user->lastname .' completed the e-mail verification.';
            $props = ['email' => $user->email, 'is_admin' => $user->is_admin];

            ActionLog::create('user', $description, $props);

            return redirect()->route('login')->with('success_message', trans('translate.verified_successfully') );

        } else { return redirect()->route('login')->withInput()->withErrors(['unexpected_error' => trans('PeopleCounter.already-verified')]); }

    }

    // Admin password change (old)
    public function passChange(Request $request) {
        // Change the current password
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = auth()->user();

        if (!$user) {
            return redirect()->back();
        }
        $password = $user->password;
        if (! \Hash::check($request['old_password'], $password)) {
            return back()->with([
                'password_error' => 'Old password is wrong'
            ]);
        }
       $new_pass = bcrypt($request['password']);
       $user->update(['password' => $new_pass]);

       return back()->with([
           'password_change_success' => trans('translate.password_changed_successfully')
       ]);
    }

    public function usernameChange(Request $request) {
        // Change the current username
        $user = auth()->user();
        if (!$user) {
            return redirect()->back();
        }

        $this->validate($request, [
            'new_username' => 'required|unique:users,name,' . $user->id
        ]);

        $new_username = $request['new_username'];

        $user->update(['name' => $new_username]);

        return back()->with(['username_change_successful' => 'Username changed successfully!']);
    }

    /*
     * Preempts $redirectTo member variable (from RedirectsUsers trait)
     */

    public function redirectTo()
    {
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('operator')) {
            return route('admin.dashboard');
        } else if (auth()->user()->is_authenticated) {
            return '/home';
        } else {
            return '/';
        }
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            // Log the user login action
            if ($user = auth()->user()) {
                $description = 'User '. $user->firstname . ' ' . $user->lastname .' logged in.';
                $props = ['email' => $user->email, 'is_admin' => $user->is_admin];
            }

            $request->session()->regenerate();
            $this->clearLoginAttempts($request);

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    // Change password functions
    public function resetPassword()
    {
        return view('access::auth.passwords.reset');
    }

    public function resetPasswordSendEmail(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required'
        ]);

        $user = User::where('email',$validatedData['email'])->first();

        if($user === null) {

            return back()->withInput()->withErrors(['unexpected_error' => "Sorry! This e-mail doesn't exist!"]);

        } else {
            $confirmation_code = Str::random(30);

            $user->confirmation_code = $confirmation_code;

            $user->save();

            \Mail::to($validatedData['email'])->send(new ResetPassword($user, $user->id, $confirmation_code));

            $description = 'User '. $user->firstname . ' ' . $user->lastname .' started the password changing.';
            $props = ['email' => $user->email, 'is_admin' => $user->is_admin];

            ActionLog::create('user', $description, $props);

            return redirect()->route('login')->with('success_message', trans('translate.reset_password_email_sent'));
        }

    }

    public function changePasswordForm($id, $confirmation_code) {
        return view('access::auth.passwords.reset_form', compact('id', 'confirmation_code'));
    }

    public function changePassword(Request $request) {

        $validatedData = $request->validate([
            'password' => 'required|confirmed'
        ]);

        $user = User::where('id', $request['id'])->where('confirmation_code', $request['confirmation_code'])->first();

        if (!$user) {
            return back()->with([
                'password_error' => 'User not found!'
            ]);
        }

        $new_pass = bcrypt($validatedData['password']);

        $user->update(['password' => $new_pass, 'confirmation_code' => null]);

        $description = 'User '. $user->firstname . ' ' . $user->lastname .' changed password.';
        $props = ['email' => $user->email, 'is_admin' => $user->is_admin];

        ActionLog::create('user', $description, $props);

        return redirect()->route('login')->with('success_message', trans('translate.password_changed_successfully'));
    }

}
