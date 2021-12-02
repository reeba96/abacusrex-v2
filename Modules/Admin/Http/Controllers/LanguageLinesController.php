<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Entities\LanguageLines;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Cache;
class LanguageLinesController extends Controller
{

    /**
     * Display a listing of the language lines.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $locale = app()->getLocale();
        $data = $request->all();

        $groups[''] = '-';
        $filter_value = "";
        $groups = array_merge($groups, LanguageLines::groupBy('group')->pluck('group','group')->toArray() );
        
        $group_filter = $request->input('group_filter','');
        $key_filter = $request->input('key_filter','');

        $query = LanguageLines::query();

        if ($request->group_filter ){
            $query = $query->where('group',$group_filter);
        }

        if ($request->key_filter ){
            $query = $query->where('key',$key_filter);
        }

        $languageLinesObjects = $query->paginate(25);

        return view('admin::language_lines.index', compact('languageLinesObjects', 'groups', 'group_filter', 'key_filter', 'locale', 'data'));
    }

    /**
     * Show the form for creating a new language lines.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $languages = \LaravelLocalization::getSupportedLocales();
        $language_keys = array_keys($languages);

        
        return view('admin::language_lines.create',compact('language_keys'));
    }

    /**
     * Store a new language lines in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
     //   try {
            
            $data = $this->getData($request);
            
            LanguageLines::create($data);

            return redirect()->route('language_lines.language_lines.index')
                ->with('success_message', trans("translate.language_line_was_successfully_added"));
     //  } catch (Exception $exception) {

       //     return back()->withInput()
        //        ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
      //  }
    }

    /**
     * Display the specified language lines.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $languageLines = LanguageLines::findOrFail($id);

        return view('admin::language_lines.show', compact('languageLines'));
    }

    /**
     * Show the form for editing the specified language lines.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $languageLines = LanguageLines::findOrFail($id);
        
        $languages = \LaravelLocalization::getSupportedLocales();
        $language_keys = array_keys($languages);

        return view('admin::language_lines.edit', compact('languageLines','language_keys'));
    }

    /**
     * Update the specified language lines in the storage.
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
           
            $languageLines = LanguageLines::findOrFail($id);

            //clear translation group cache for all languages
            $language_keys = array_keys(\LaravelLocalization::getSupportedLocales());
            foreach ($language_keys as $lang_key => $code){
                Cache::forget('spatie.translation-loader.'.$data['group'].'.'.$code );
            }
            

            $languageLines->update($data);

            return redirect()->route('language_lines.language_lines.index')
                ->with('success_message', trans("translate.language_line_was_successfully_updated"));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }        
    }

    /**
     * Remove the specified language lines from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $languageLines = LanguageLines::findOrFail($id);
            $languageLines->delete();

            return redirect()->route('language_lines.language_lines.index')
                ->with('success_message', trans("translate.language_line_was_successfully_deleted"));
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
            'group' => 'required|string|min:1|max:255',
            'key' => 'required|string|min:1|max:255',
          //  'text' => 'required', 
        ];
        
        $data = $request->validate($rules);

        // add post fields into text json
        if( $request->text_langs){

            if( !isset($data['text']) ){
                $languages = \LaravelLocalization::getSupportedLocales();
                $language_keys = array_keys($languages);
                $text_arr = [];
                foreach ($language_keys as $key => $code){
                    $text_arr[$code] = '';
                }
            }
            else{
                $text_arr = json_decode($data['text'],true); //convert to array
            }

            
            foreach ($request->text_langs as $lang => $value){
                $text_arr[$lang] = $value;
            }
            $data['text'] = json_encode($text_arr);
        }

        return $data;
    }

}
