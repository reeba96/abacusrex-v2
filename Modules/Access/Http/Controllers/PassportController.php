<?php

namespace Modules\Access\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Laravel\Passport\Passport;
use Exception;

class PassportController extends Controller
{

   

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $tokens = Passport::token()->get();
        return view('access::passport.index',compact('tokens'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('access::passport.create');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $passport = Passport::token()->where('id',$id)->first();
            $passport->delete();

            return redirect()->route('access.passport.index')
                ->with('success_message', 'Token was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }
    }


   
}
