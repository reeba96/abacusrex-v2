<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use Modules\Admin\Entities\CmsModule;
use Config;
use Illuminate\Support\Facades\DB;
use Nwidart\Modules\Facades\Module;
class ModulesController extends Controller 
{

    public function index(Request $request)
    {
       /* $path = base_path('modules/CMS/cms_apps/');
        $directories = array_map('basename', File::directories($path));
        $all_modules = $directories;
        $installed = Module::pluck('name')->toArray();
        $not_installed = [];       

        foreach ($all_modules as $all) {
            if (!in_array($all, $installed)) {
                $not_installed[] = $all;
            }
        }
        */
        $all_modules = Module::all();
        unset($all_modules['Admin']);
        unset($all_modules['ZFront']);
        unset($all_modules['Tag']);
        unset($all_modules['Access']);
       
        

        $installed = CmsModule::where('is_installed',1)->pluck('name')->toArray();
        $modules_array = [];
        foreach( $all_modules as $module){
            if (!in_array($module,$installed))
                $modules_array[] = $module->getName();
        }
        $not_installed = $modules_array;
  
        return view('admin::admin.menu.modules', compact('not_installed', 'installed'));
    }

    public function doInstall($module_name) {
        
        
        $config_filename = base_path('Modules/'.$module_name.'/Config/config.php');

        $config = require($config_filename);
       

      //  dd($config_filename);
        if ( isset($config) ){
         //   $config_txt = ltrim(file_get_contents($config_filename),'<?php');
            
            $module = CmsModule::create($config);
            \App::call('\Modules\\'.$module_name.'\Http\Controllers\InstallController@doInstall',['cmsModule'=>$module]);
        }
     
      
        
        
        
        return back();
       // \CMS\cms_apps\ContactPage\Controllers\Install::doInstall();
    }
    
    public function doUninstall($module_name) {
       
        //\App::call('bla\bla\ControllerName@doUninstall');
        $cmsModule = CmsModule::where('name',$module_name)->first();
        \App::call('\Modules\\'.$module_name.'\Http\Controllers\InstallController@doUnInstall',['cmsModule'=>$cmsModule]);
      
        DB::table('modules')->where('name', $module_name)->delete();
        return redirect()->route('modules');
        // action = modify_DB || modify_data
       /*$file = Config::get($config);
        $action = $file['action'];
        
        if ($action == 'modify_DB') {
            
            $table = $file['table'];
            $columns = $file['columns'];
            
            foreach ($columns as $key => $value) {
                \DB::statement('ALTER TABLE ' . $table . ' DROP COLUMN ' . $value);
            }      
            return true;
        } else if ($action == 'modify_data') {
            $tables_data = $file['tables_data'];
            
            foreach ($tables_data as $table => $fields) {
                if ($table == 'pages') {
                    DB::table($table)->where('module_name', $fields['module_name'])->delete();
                } else if ($table == 'articles') {
                    DB::table($table)->where('name', $fields['name'])->delete();
                }
            }
            
            return true;
        } else {
            return false;
        }*/
    }
    
    public function getInformation(Module $module) {
        $information = $module->description;
        return view('admin::admin.layouts.module_information', compact('information'));
    }
}
