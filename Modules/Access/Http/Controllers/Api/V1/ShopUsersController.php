<?php

namespace Modules\Access\Http\Controllers\Api\V1;

use Modules\Access\Entities\User;
use Modules\Access\Entities\Role;
use Modules\Access\Entities\Permission;
use Modules\Access\Entities\Country;
use Modules\Access\Http\Controllers\Api\V1\ApiController;

use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Crypt;

class ShopUsersController extends APIController
{

   /**
     * Get the users password hash and return it to the shop.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function getHash(Request $request){


        $user = User::where('email',$request->email)->first();

        if ( $user){
            return ['status' => 'OK',
                    'hash' => $user->password ];

        }
        else
            return ['status' => 'error'];

    }


    /**
     * Store the new password hash after the password change.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request){


        $user = User::where('email',$request->email)->first();

        if ($user){
            $user->password = $request->hash;
            $user->save(); 
            return ['status' => 'OK' ];
        }
        else
            return ['status' => 'error'];

    }

    /**
     * Store a new user in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
     //  try {
          
            $data = $this->getData($request);
            \Log::notice(['data'=> $data]);
          //  $data['password'] = Crypt::decryptString($data['password']);
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

            return ['result' => 'ok'];
     /*   } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }*/
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
                ->with('success_message', 'User was successfully updated.');
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
          //      'confirmation_code' => 'nullable|string|min:0|max:255',
            'confirmed' => 'boolean',
            'country_id' => 'nullable',
            'firm' => 'nullable',
            'mobile' => 'nullable',
            'phone' => 'nullable',
            'title' => 'nullable',
            'skype' => 'nullable',
            'email' => 'required|string|min:1|max:255',
           // 'email_verified_at' => 'nullable|date_format:j/n/Y g:i A',
         
            'name' => 'required|string|min:1|max:255',
            'password' => 'required',
            //'remember_token' => 'nullable|string|min:0|max:100', 
        ];
        
        $data = $request->validate($rules);

        $data['confirmed'] = $request->has('confirmed');
        return $data;
    }



    

}
