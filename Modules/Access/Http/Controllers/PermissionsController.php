<?php

namespace Modules\Access\Http\Controllers;

use Modules\Access\Entities\Permission;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Exception;

class PermissionsController extends Controller
{

    /**
     * Display a listing of the permissions.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $permissionsObjects = Permission::paginate(25);

        return view('access::permissions.index', compact('permissionsObjects'));
    }

    /**
     * Show the form for creating a new permissions.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('access::permissions.create');
    }

    /**
     * Store a new permissions in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Permission::create($data);

            return redirect()->route('permissions.permission.index')
                ->with('success_message', trans("translate.permission_was_successfully_added") );
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }
    }

    /**
     * Display the specified permissions.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $permissions = Permission::findOrFail($id);

        return view('access::permissions.show', compact('permissions'));
    }

    /**
     * Show the form for editing the specified permissions.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $permissions = Permission::findOrFail($id);
        

        return view('access::permissions.edit', compact('permissions'));
    }

    /**
     * Update the specified permissions in the storage.
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
            
            $permissions = Permission::findOrFail($id);
            $permissions->update($data);

            return redirect()->route('permissions.permission.index')
                ->with('success_message', trans("translate.permission_was_successfully_updated"));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }        
    }

    /**
     * Remove the specified permissions from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $permissions = Permission::findOrFail($id);
            $permissions->delete();

            return redirect()->route('permissions.permission.index')
                ->with('success_message', trans("translate.permission_was_successfully_deleted"));
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
            //'guard_name' => 'required|string|min:1|max:255', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
