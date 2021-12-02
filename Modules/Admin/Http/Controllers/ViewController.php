<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Entities\SlideShowImage;
use Modules\Admin\Entities\Article;
use Modules\Admin\Entities\Module;
use Modules\Admin\Entities\Page;
use Modules\Admin\Entities\User;
use Illuminate\Support\Facades\File;

/*******************************************************************************
    Controller returns only views (balde files),
    sometimes a value if it is necessary
********************************************************************************/

class ViewController extends Controller
{
    public function valami() {
        return view('admin::valami');
    }

    public function home() {
        return view('admin::welcome');
    }

    public function admin() {
        return view('admin::login');
    }

    public function dashboard() {
        $page_pagination = Page::paginate(4, ['*'], 'pages');
        $article_pagination = Article::paginate(5, ['*'], 'articles');

        return view('admin::admin.home', compact(['page_pagination','article_pagination']));
    }

    public function profile() {
        return view('admin::admin.menu.profile');
    }

    public function users() {
        return view('admin::admin.menu.users');
    }

    public function media() {
        return view('admin::menu.media');
    }

    public function sliders() {
      return view('admin::admin.menu.sliders');
    }
    /*********************************************
        SLIDER ACTIONS
    **********************************************/
    public function newSliderImage() {
       return view('admin::admin.layouts.slider-image-list');
    }

    public function deleteSliderImage() {
      // megvalositani a torlest a bazisbol

      // ujratolteni a kinezetet torles
      return view('admin::admin.layouts.slider-image-list');
    }

    public function getSlideOptions(Request $request) {
      $id = $request['id'];
      $slide = SlideShowImage::findOrFail($id);
      return view('admin::admin.layouts.slider-image-edit', compact(['slide']));
    }

    public function getItemProperties(Request $request) {
      $id = $request['id'];
      return view('admin::admin.layouts.slide-item-properties', compact('id'));
    }


    

    public function refreshJS() {
      return view('admin::admin.includes.script');
    }
    
    public function settings() {
        return view('admin::admin.menu.web-settings');
    }

    public function modules() {
        $path = base_path('modules/CMS/cms_apps/');
        $directories = array_map('basename', File::directories($path));
        $all_modules = $directories;
        $installed = Module::pluck('name')->toArray();
        $not_installed = [];       

        foreach ($all_modules as $all) {
            if (!in_array($all, $installed)) {
                $not_installed[] = $all;
            }
        }
        
        return view('admin::admin.menu.modules', compact('not_installed', 'installed'));
    }
}
