<?php

namespace Modules\Access\Http\Controllers;

use Modules\Access\Entities\User;
use Modules\Access\Entities\Role;
use Modules\Access\Entities\Permission;
use Modules\Access\Entities\Country;

use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use Exception;

class UsersController extends Controller
{

    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = User::query();

        $firstname_filter = $request->input('firstname_filter','');
        if ($firstname_filter){
            $query = $query->where('firstname','like', '%'.$firstname_filter.'%');
        }

        $lastname_filter = $request->input('lastname_filter','');
        if ($lastname_filter){
            $query = $query->where('lastname','like', '%'.$lastname_filter.'%');
        }

        $email_filter = $request->input('email_filter','');
        if ($email_filter){
            $query = $query->where('email','like', '%'.$email_filter.'%');
        }

        $users = $query->paginate(25);

        return view('access::users.index', compact('users','firstname_filter', 'lastname_filter', 'email_filter'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $roleObjects = Role::get();
        $locale = app()->getLocale();
        $user_roles = [];

        $country_options[] = '-';
        $country_options = $country_options + Country::get()->pluck('name_'.$locale,'id')->toArray();

        return view('access::users.create',compact('roleObjects','user_roles','country_options'));
    }

    /**
     * Store a new user in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            $user = User::create($data);

            $target_dir = config('users.images_dir');

            if ($target_dir) {

                if ( !file_exists($target_dir) ) {
                    Storage::makeDirectory($target_dir);
                }

                if ( $request->image){
                    $filename =  $request->image->getClientOriginalName();
                    $name = explode('.', $filename);
                    $filename_as = 'user_'.$user->id.'.'.$name[1];

                    $request->image->storeAs($target_dir, $filename_as);
                    $user->image = $filename_as;
                    $user->save();
                }
            }

            if( $request->roles ){
                $user->syncRoles($request->roles);
            }

            return redirect()->route('users.user.index')
                ->with('success_message', trans("translate.user_was_successfully_added"));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('access::users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $permissionObjects = Permission::get();
        $roleObjects = Role::get();

        $locale = app()->getLocale();

        $country_options[] = '-';
        $country_options = $country_options + Country::get()->pluck('name_'.$locale,'id')->toArray();

        $role_permissions = $user->permissions()->get()->pluck('id')->toArray();
        $user_roles = $user->roles()->get()->pluck('id')->toArray();

        $InvoiceAccounts = InvoiceAccount::where('user_id', $user->id)->get();
        $account_types = config('PeopleCounter.account_type');

        return view('access::users.edit', compact('user','permissionObjects','role_permissions','roleObjects','user_roles','country_options', 'InvoiceAccounts', 'account_types'));
    }

    /**
     * Update the specified user in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {

            $data = $this->getData($request);

            $user = User::findOrFail($id);
            $user->update($data);

            $target_dir = config('users.images_dir');

            if ($target_dir) {

                if ( !file_exists($target_dir) ) {
                    Storage::makeDirectory($target_dir);
                }

                if ( $request->image){
                    $filename =  $request->image->getClientOriginalName();
                    $name = explode('.', $filename);
                    $filename_as = 'user_'.$user->id.'.'.$name[1];

                    $request->image->storeAs($target_dir, $filename_as);
                    $user->image = $filename_as;
                    $user->save();
                }
            }

            return redirect()->route('users.user.index')
                ->with('success_message', trans("translate.user_was_successfully_updated"));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }
    }


    public function changePassword($id, Request $request) {
        try {
            $user = User::findOrFail($id);

            $data['password'] = \Hash::make($request->password);
            
            $user->update($data);
            

            return redirect()->route('users.user.index')
            ->with('success_message', trans("translate.user_was_successfully_updated"));

        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }
    }

    /**
     * Update the specified User's roles in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */

    public function updateRoles($id, Request $request)
    {
       // try {
            // Reset cached roles and permissions
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            $data = $request->all();

            if( $request->roles ){

                $user = User::findOrFail($id);
               /* foreach($request->permissions as $key => $value ){
                    $user->givePermissionTo($value);
                }*/
                $user->syncRoles($request->roles);
            }



            return redirect()->route('users.user.index')
                ->with('success_message', trans("translate.role_was_successfully_added"));
     /*   } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }    */
    }

 /**
     * Update the specified User's permisson in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */

    public function updatePermissions($id, Request $request)
    {
        try {
            // Reset cached roles and permissions
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            $data = $request->all();

            if( $request->permissions ){

                $user = User::findOrFail($id);
               /* foreach($request->permissions as $key => $value ){
                    $user->givePermissionTo($value);
                }*/
                $user->syncPermissions($request->permissions);
            }



            return redirect()->route('users.user.index')
                ->with('success_message', trans("translate.permission_was_successfully_added"));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }
    }

    /**
     * Remove the specified user from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->delete()) {
                return redirect()->route('users.user.index')
                ->with('success_message', trans("translate.user_was_successfully_deleted"));
            } else {
                return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
            }
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {

        $rules = [
            'firstname' => 'required|string|min:1|max:255',
            'lastname' => 'required|string|min:1|max:255',
            'confirmed' => 'boolean',
            'country_id' => 'nullable',
            'firm' => 'nullable',
            'mobile' => 'nullable',
            'phone' => 'nullable',
            'title' => 'nullable',
            'skype' => 'nullable',
            'email' => 'required|string|min:1|max:255',
            // 'confirmation_code' => 'nullable|string|min:0|max:255',
            // 'email_verified_at' => 'nullable|date_format:j/n/Y g:i A',
            'password' => 'required|string|min:1|max:255',
            //'remember_token' => 'nullable|string|min:0|max:100',
        ];

        $data = $request->validate($rules);

        $data['confirmed'] = $request->has('confirmed');
        $data['password'] = \Hash::make($request->password);

        return $data;
    }

}
