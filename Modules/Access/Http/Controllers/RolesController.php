<?php

namespace Modules\Access\Http\Controllers;

use Modules\Access\Entities\Role;
use Modules\Access\Entities\Permission;

//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Exception;

class RolesController extends Controller
{

    /**
     * Display a listing of the roles.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $rolesObjects = Role::paginate(25);

        return view('access::roles.index', compact('rolesObjects'));
    }

    /**
     * Show the form for creating a new roles.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('access::roles.create');
    }

    /**
     * Store a new roles in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Role::create($data);

            return redirect()->route('roles.role.index')
                ->with('success_message',  trans("translate.role_was_successfully_added"));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }
    }

    /**
     * Display the specified roles.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        return view('access::roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified roles.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        
        $permissionsObjects = Permission::get();
        $role_permissions = $role->permissions()->get()->pluck('id')->toArray();

        return view('access::roles.edit', compact('role','permissionsObjects','role_permissions'));
    }

    /**
     * Update the specified roles in the storage.
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
            
            $roles = Role::findOrFail($id);
            $roles->update($data);

            return redirect()->route('roles.role.index')
                ->with('success_message',  trans("translate.role_was_successfully_updated"));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }        
    }

     /**
     * Update the specified role's permisson in the storage.
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

                $role = Role::findOrFail($id);
               /* foreach($request->permissions as $key => $value ){
                    $role->givePermissionTo($value);
                }*/
                $role->syncPermissions($request->permissions);
            }
            
           

            return redirect()->route('roles.role.index')
                ->with('success_message',  trans("translate.permission_was_successfully_updated"));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }      
    }

    /**
     * Remove the specified roles from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $roles = Role::findOrFail($id);
            $roles->delete();

            return redirect()->route('roles.role.index')
                ->with('success_message',  trans("translate.role_was_successfully_deleted"));
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
            'name' => 'required|string|min:1|max:255',
            'guard_name' => 'nullable|string|min:0|max:255', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
