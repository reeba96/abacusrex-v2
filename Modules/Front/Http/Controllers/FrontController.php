<?php

namespace Modules\Front\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('front::index');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function esFinx()
    {
        return view('front::esfinx');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function budzetski()
    {
        return view('front::budzetski');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function vodovod()
    {
        return view('front::vodovod');
    }

}
