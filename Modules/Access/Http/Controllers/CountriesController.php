<?php

namespace Modules\Access\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Access\Entities\Country;
use Illuminate\Http\Request;
use Exception;

class CountriesController extends Controller
{

    /**
     * Display a listing of the countries.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $countriesObjects = Country::paginate(25);

        return view('access::countries.index', compact('countriesObjects'));
    }

    /**
     * Show the form for creating a new countries.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('access::countries.create');
    }

    /**
     * Store a new countries in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Country::create($data);

            return redirect()->route('countries.country.index')
                ->with('success_message', trans("translate.country_was_successfully_added"));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }
    }

    /**
     * Display the specified countries.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $countries = Country::findOrFail($id);

        return view('access::countries.show', compact('countries'));
    }

    /**
     * Show the form for editing the specified countries.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $countries = Country::findOrFail($id);
        

        return view('access::countries.edit', compact('countries'));
    }

    /**
     * Update the specified countries in the storage.
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
            
            $countries = Country::findOrFail($id);
            $countries->update($data);

            return redirect()->route('countries.country.index')
                ->with('success_message', trans("translate.country_was_successfully_updated"));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }        
    }

    /**
     * Remove the specified countries from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $countries = Country::findOrFail($id);
            $countries->delete();

            return redirect()->route('countries.country.index')
                ->with('success_message', trans("translate.country_was_successfully_deleted"));
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
            'name_en' => 'required|string|min:1|max:255',
            'name_hu' => 'required|string|min:1|max:255', 
        ];
        
        $data = $request->validate($rules);
        $data['name_de'] = '';

        return $data;
    }

}
