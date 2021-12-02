<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Input;
use Modules\Admin\Http\Entities\EmailVerification;
use Modules\Admin\Http\Entities\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

/* ACCESS MODULE'S AuthController is doing the work */
class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function credentials(Request $request)
    {
        return ['email' => $request->{$this->username()}, 'password' => $request->password, 'confirmed' => 1];
    }

    public function destroy() {
        $user = auth()->user();
        // Logout the user
        auth()->logout();

        // Log the user login action
        if ($user) {
            $description = 'User '. $user->firstname . ' ' . $user->lastname .' logged out.';
            $props = ['email' => $user->email, 'is_admin' => $user->is_admin];
        }

        return redirect()->route('login');
    }

    public function getRegister() {
        // Load the register blade
        return view('admin::admin.register');
    }

    public function store(Request $request) {
        // Create new user and store in DB (password hash, email sending)

        $request['name'] = $request->username;

        $this->validate($request, [
            'username' => 'required|unique:users,name',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $confirmation_code = str_random(30);

        $user = User::create([
           'name' => $request['username'],
           'email' => $request['email'],
           'confirmation_code' => $confirmation_code,
           'password' => bcrypt($request['password'])

        ]);

        \Mail::to($user)->send(new EmailVerification($user, $confirmation_code));
        $request->session()->flash('message', 'Registration successfully completed!');

        return redirect()->back();
    }

    public function confirm($confirmation_code)
    {
        $user = User::where('confirmation_code', $confirmation_code)
            ->update([
                'confirmed' => 1,
                'confirmation_code' => null
            ]);

        return redirect()->route('login');
    }

    public function passChange(Request $request) {
        // Change the current password

        $request->validate([
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

        $request->validate([
            'new_username' => 'required|unique:users,firstname,lastname' . $user->id
        ]);

        $new_username = $request['new_username'];

        $user->update(['firstname' => $new_username]);

        return back()->with(['username_change_successful' => trans('translate.username_changed_successfully')]);
    }

    /*
     * Preempts $redirectTo member variable (from RedirectsUsers trait)
     */
    public function redirectTo()
    {
        return route('dashboard');
    }


}
