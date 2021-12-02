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
use Validator;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class AuthController extends APIController
{

     /**
     * Login 
     * @bodyParam email string required Example: test@example.com
     * @bodyParam password string required Example: test
     * @bodyParam install_id string required Example: 76f90436-1a72-463d-8dab-828aa48eb439
     * @response {
     * @response {
     * "status" : "OK",
     * "token"    : "eyJ0eXAiOiJKV1....."
     * }
     * @response 500 
     * {
     * "error": {
     *    "message": "api.messages.login.failed",
     *    "status_code": 422
     *  }
     * }
     * 
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request){

        $validation = Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required|min:3',
            'install_id'=> 'required'
        ]);

        if ($validation->fails()) {
            return $this->setStatusCode(422)
                        ->respondWithError($validation->messages()->first());
            
        }
        
        $user = User::where("email",$request->email)->first();
        if ($user && Hash::check($request->password,$user->password)) {

            //find and delete existing tokens for that user on the specific device
            DB::table('oauth_access_tokens')
                ->where('install_id', $request->install_id)
                ->delete();



            $token = $user->createToken($user->email);
            DB::table('oauth_access_tokens')
                    ->where('id', $token->token->id)
                    ->update(['install_id' => $request->install_id]);
          
            return $this->respond([
                'status'   => 'OK',//trans('api.messages.login.success'),
                'token'     => $token->accessToken,
            ]);
        }
        else{
            return $this->setStatusCode(422)
                ->respondWithError(trans('api.messages.login.failed')); 
        }

    }

    /**
     * Logout 
     * @queryParam token required token string 
     * @response {
     * "status" : "OK",
     * "token"    : "23232sometoken23232323"
     * }
     * @response 422 
     * {
     * "error": {
     *    "message": "api.messages.logout.failed",
     *    "status_code": 422
     *  }
     * }
     * 
     * @return \Illuminate\Http\JsonResponse
     */

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        return $this->respond([
            'status'   => 'OK',//trans('api.messages.login.success'),
            'message'  => trans('api.messages.logout.success')
        ]);
    }
}
