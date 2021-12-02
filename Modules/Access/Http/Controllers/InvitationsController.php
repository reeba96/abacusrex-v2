<?php

namespace Modules\Access\Http\Controllers;

use Modules\Access\Entities\Invitation;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Access\Emails\InvitationEmail;
use Illuminate\Support\Facades\Mail;
use Exception;

class InvitationsController extends Controller
{

    /**
     * Display a listing of the invitations.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $invitations = Invitation::paginate(25);

        return view('access::invitations.index', compact('invitations'));
    }

    /**
     * Show the form for creating a new invitation.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('access::invitations.create');
    }

    /**
     * Store a new invitation in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $data = $this->getData($request);
            $data['invitation_token'] = substr(md5(rand(0, 9) . $data['email'] . time()), 0, 32);
            $data['expires_at'] = \Carbon\Carbon::now()->addDays(7);
            $invitation = Invitation::create($data);

            Mail::to($invitation->email)->send(new InvitationEmail($invitation));

            $user = auth()->user();
            $description = 'Admin '. $user->firstname . ' ' . $user->lastname .' sent verification e-mail to ' . $data['email'] .'.';
            $props = ['email' => $user->email, 'is_admin' => $user->is_admin];
            
            return redirect()->route('invitations.invitation.index')
                ->with('success_message',  trans("translate.invitation_was_successfully_added"));

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }
    }

    /**
     * Display the specified invitation.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $invitation = Invitation::findOrFail($id);

        return view('access::invitations.show', compact('invitation'));
    }

    /**
     * Show the form for editing the specified invitation.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $invitation = Invitation::findOrFail($id);
        

        return view('access::invitations.edit', compact('invitation'));
    }

    /**
     * Update the specified invitation in the storage.
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
            
            $invitation = Invitation::findOrFail($id);
            $invitation->update($data);

            return redirect()->route('invitations.invitation.index')
                ->with('success_message', trans("translate.invitation_was_successfully_updated"));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }        
    }

    /**
     * Remove the specified invitation from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $invitation = Invitation::findOrFail($id);
            $invitation->delete();

            return redirect()->route('invitations.invitation.index')
                ->with('success_message', trans("translate.invitation_was_successfully_deleted"));
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
                'email' => 'required|string|min:1|max:255',
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
