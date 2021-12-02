<?php 

namespace Modules\Access\Http\Middleware;

use Modules\Access\Entities\Invitation;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HasInvitation
{

    public function handle($request, Closure $next)
    {
        /**
         * Only for GET requests. Otherwise, this middleware will block our registration.
         */
        if ($request->isMethod('get')) {

            /**
             * No token = Goodbye.
             */
            if (!$request->has('invitation_token')) {
                return abort(404);//redirect(route('requestInvitation'));
            }

            $invitation_token = $request->get('invitation_token');

            /**
             * Lets try to find invitation by its token.
             * If failed -> return to request page with error.
             */
            try {
                $invitation = Invitation::where('invitation_token', $invitation_token)->where('expires_at','>=',\Carbon\Carbon::now())->firstOrFail();
            } catch (ModelNotFoundException $e) {
                return abort(400, 'Wrong invitation token or expired! Please check your URL.');
                //return redirect(route('requestInvitation'))
                //    ->with('error', 'Wrong invitation token! Please check your URL.');
            }

            /**
             * Let's check if users already registered.
             * If yes -> redirect to login with error.
             */
            if (!empty($invitation->registered_at)) {
                return redirect(route('login'))->with('error', 'The invitation link has already been used.');
            }
        }
        return $next($request);
    }
}