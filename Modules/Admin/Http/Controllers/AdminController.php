<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Access\Entities\User;
use Modules\Access\Entities\Invitation;

class AdminController extends Controller
{
	public function get() {
		return view("admin::index");
	}

	public function dashboard() {
        $user_count = User::count();
        $invitation_count = Invitation::whereNull('registered_at')->count();

        return view('admin::admin.home', compact(['user_count', 'invitation_count']));
    }
     /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function index()
    {
     //   $languages = \LaravelLocalization::getSupportedLocales();
     //               dd(array_keys($languages));
        return view('admin::index');
    }
}



