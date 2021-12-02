<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\CmsModule;
use Modules\Admin\Entities\Article;
use Modules\Admin\Entities\Image; 
use Modules\Admin\Entities\Page;
use Config;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PageController extends Controller {

    // Returns the view with all the attributes when the user select a page or
    // an article in the FancyTree
    
    public function createPage(Request $request) {
        //$page_id = $request->id;
        
        $page_id = ltrim($request->input('id'),'p#');

        $page = new Page;
        $page->id_parent = $page_id;

        return view('admin::admin.menu.create-page', compact($page));
    }
    
    
    public function index(){
        return view('admin::admin.index');
    }
    
     public function edit(Request $request) {

        $languages = \LaravelLocalization::getSupportedLocales();
        $language_keys = array_keys($languages);
        $installed_modules = CmsModule::getInstalled();
        //$page_id = $request->input('page_id');
        $page_id = ltrim($request->input('page_id'),'p#');
      
        $page_permissions = \Modules\Access\Entities\Permission::where('name','like','page%')->pluck('name','id')->toArray();
     
        $page_permissions = ['' => '-'] + $page_permissions;
        $parent_id = ltrim($request->input('parent_id'),'p#');
     
     //   var_dump($parent_id,$request->parent_id);
        if( $page_id){
            $page = Page::find($page_id);
        }
        else{
            $page = new Page;
            $page->parent_id = $parent_id;
        }
        $page_views = config('theme.page_views');
        
      
        return view('admin::admin.page-form', compact(['page', 'parent_id','installed_modules','page_views','languages','language_keys','page_permissions']));
    }
    
    
  /*  public function getPageFromTree(Request $request) {        
        $parent_id = $request['parent'];
        $installed_modules = Module::all();
        
        if ($request['type'] == 'page') {
            $page = Page::find($request['id']);
            
            return view('admin::admin.page-form', compact('page', 'installed_modules'));
        } elseif ($request['type'] == 'article') {
            $article = Article::find($request['id']);
            $all_media = $article->medias()
                              ->orderBy('order_no')
                              ->get();

            return view('admin::admin.article-form', compact(['article', 'parent_id', 'all_media', 'installed_modules']));
        } else {
            return "Error! Something went wrong!";
        }
    }*/

    // Funciton for storing a new page entity
    public function store(Request $request) {
        $user_id = auth()->user()->id;
        $date = date("Y-m-d");

        $data = $request->all();
        unset($data['page_id']);
        unset($data['published']);
        $data['order_no'] = 999;
        $data['user_id'] = $user_id;

        if ($request['appears'] == 'on') {
            $data['appears'] = 1;
        } else {
            $data['appears'] = 0;
        }

        if ($request['bc'] == 'on') {
            $data['bc'] = 1;
        } else {
            $data['bc'] = 0;
        }

        if ($request['featured'] == 'on') {
            $data['featured'] = 1;
        } else {
            $data['featured']= 0;
        }

        if ($request['articles_nav'] == 'on') {
            $data['articles_nav'] = 1;
        } else {
            $data['articles_nav']  = 0;
        }

        if ($request['display_in_homepage'] == 'on') {
            $data['display_in_homepage'] = 1;
        } else {
            $data['display_in_homepage'] = 0;
        }

        $languages = \LaravelLocalization::getSupportedLocales();
        $language_keys = array_keys($languages);
        foreach ($language_keys as $key => $code){
                unset($data['auto_'.$code]);
        }
        $data['date_posted']  = $date;
        $page = Page::create($data);

        
/*
        $page = Page::create([
            'parent_id' => $request['parent_id'],
            'view' => $request['view'],
            'article_ordering' => $request['article_ordering'],
            'per_page' => $request['per_page'],
            'appears' => $appears,
            'articles_nav' => $articles_nav,
            'bc' => $bc,
            'featured' => $featured,
            'description_en' => $request['description_en'],
            'description_sr' => $request['description_sr'],
            'description_hu' => $request['description_hu'],
            'title_en' => $request['title_en'],
            'title_sr' => $request['title_sr'],
            'title_hu' => $request['title_hu'],
            'author_id' => $user_id,
            'url_en' => $request['url_en'],
            'url_sr' => $request['url_sr'],
            'url_hu' => $request['url_hu'],
            'page_langs' => $request['page_langs'],
            'date_posted' => $date
        ]);
        */
        $urls = $request->only(['url_en']);
        
        // check installed modules, and its form elements
        $installed = CmsModule::getInstalled();
        if (count($installed) != 0) {
            
            $protocol = explode('/', strtolower(request()->server('SERVER_PROTOCOL')));
            
            foreach ($installed as $ins) {
               if (Config::get($ins->config_file . '.modify_DB')) {
                   $columns = Config::get($ins->config_file . '.columns');
                   foreach ($columns as $value) {
                       // csak checkboxokra ervenyes
                       if ($request[$value] == 'on') {
                            $page->$value = true;
                            
                            // Generate QR Code for the page
                            if ($value == 'qrcode') {
                                foreach ($urls as $ind => $url) {
                                    if (!empty($url)) {
                                        $qr_code_path = 'images/qr_codes';
            
                                        if (!file_exists(public_path($qr_code_path))) {
                                            mkdir(public_path($qr_code_path), 0777, true);
                                        }
                                        
                                        $url = $protocol[0] . '://' . $request->server('HTTP_HOST') . '/en/' . $url;

                                        $page_qr_code = $page->qrCodeGen()->create([
                                            'url' => $url,
                                        ]);
                                        
                                        $qr_code_photo_name = $page_qr_code->id . '.png';

                                        QrCode::format('png')->size(200)->generate($url, public_path($qr_code_path) . '/' . $qr_code_photo_name);
                                        
                                        $page_qr_code->update([
                                            'photo' => $qr_code_photo_name
                                        ]);
                                    }
                                }
                            }
                       } else {
                            $page->$value = false;
                       }
                   }
               } 
            }
            
            $page->save();
        }

        return redirect()->back()->with('status', 'Page saved!');
    }

    // Function for updating a page
    public function update(Request $request, $id) {     
        $page = Page::findOrFail($id);

        $data = $request->all();
       

        $languages = \LaravelLocalization::getSupportedLocales();
        $language_keys = array_keys($languages);
        foreach ($language_keys as $key => $code){
                unset($data['auto_'.$code]);
        }
       

        if ($request['appears'] == 'on') {
            $data['appears'] = 1;
        } else {
            $data['appears'] = 0;
        }

        if ($request['bc'] == 'on') {
            $data['bc'] = 1;
        } else {
            $data['bc'] = 0;
        }

        if ($request['featured'] == 'on') {
            $data['featured'] = 1;
        } else {
            $data['featured']= 0;
        }

        if ($request['articles_nav'] == 'on') {
            $data['articles_nav'] = 1;
        } else {
            $data['articles_nav']  = 0;
        }

        if ($request['display_in_homepage'] == 'on') {
            $data['display_in_homepage'] = 1;
        } else {
            $data['display_in_homepage'] = 0;
        }

        $page->update($data);

      /*  $page->parent_id = $request['parent_id'];
        $page->view = $request['view'];
        $page->article_ordering = $request['article_ordering'];
        $page->per_page = $request['per_page'];
        $page->page_langs = $request['page_langs'];
        $page->title_en = $request['title_en'];
        $page->title_sr = $request['title_sr'];
        $page->title_hu = $request['title_hu'];
        $page->url_en = $request['url_en'];
        $page->url_sr = $request['url_sr'];
        $page->url_hu = $request['url_hu'];
        $page->description_en = $request['description_en'];
        $page->description_sr = $request['description_sr'];
        $page->description_hu = $request['description_hu'];
*/
       
        
        $urls = $request->only(['url_en']);
        
        // check installed modules, and its form elements
        $installed = CmsModule::getInstalled();
        if (count($installed) != 0) {
            
            $protocol = explode('/', strtolower(request()->server('SERVER_PROTOCOL')));
            
            foreach ($installed as $ins) {
               if (Config::get($ins->config_file . '.modify_DB')) {
                   $columns = Config::get($ins->config_file . '.columns');
                   foreach ($columns as $value) {
                       // csak checkboxokra ervenyes
                       if ($request[$value] == 'on') {
                            $page->$value = true;
                            
                            // Generate QR Code for the page
                            if ($value == 'qrcode') {
                                foreach ($urls as $ind => $url) {
                                    if (!empty($url)) {
                                        $qr_code_path = 'images/qr_codes';
            
                                        if (!file_exists(public_path($qr_code_path))) {
                                            mkdir(public_path($qr_code_path), 0777, true);
                                        }

                                        $url = $protocol[0] . '://' . $request->server('HTTP_HOST') . '/en/' . $url;

                                        if ($page->qrCodeGen) {
                                            $page->qrCodeGen()->update([
                                                'url' => $url,
                                            ]);
                                            
                                            $qr_code_photo_name = $page->qrCodeGen->id . '.png';
                                            
                                            QrCode::format('png')->size(200)->generate($url, public_path($qr_code_path) . '/' . $qr_code_photo_name);

                                            $page->qrCodeGen->update([
                                                'photo' => $qr_code_photo_name
                                            ]);
                                        } else {
                                            $page_qr_code = $page->qrCodeGen()->create([
                                                'url' => $url,
                                            ]);
                                            
                                            $qr_code_photo_name = $page_qr_code->id . '.png';

                                            QrCode::format('png')->size(200)->generate($url, public_path($qr_code_path) . '/' . $qr_code_photo_name);

                                            $page_qr_code->update([
                                                'photo' => $qr_code_photo_name
                                            ]);
                                        }
                                        
                                        
                                    }
                                }
                            }
                       } else {
                            if ($value == 'qrcode') {
                                $qr_code_path = 'images/qr_codes';

                                if ($page->qrCodeGen) {
                                    if (file_exists($path = public_path($qr_code_path) . '/' . $page->qrCodeGen->getAttributes()['photo'])) {
                                        unlink($path);
                                    }
                                 
                                    $page->qrCodeGen()->delete();
                                }
                            }
                            
                            $page->$value = false;
                       }
                   }
               } 
            }
        }

        $page->save();
        return redirect()->back()->with('status', 'Page updated!');
    }

    // Function for deleting selected page
    public function destroy(Request $request) {
        $id = $request['id'];

        $page = Page::findOrFail($id);

        // If the page really exists
        if ($page) {
            // get its childs (articles)
            $articles = $page->articles;

            // if there is a child/children
            if ($articles) {
                // delete the relationship with children in article_page table
                foreach ($articles as $a) {
                    $article = DB::table('article_page')
                                    ->where('article_id', $a->id)
                                    ->where('page_id', $id)->delete();
                }

                // If the child articles used by another page do nothing
                // else delete the article and it's all medias
                foreach ($articles as $a) {
                    $article = DB::table('article_page')
                                    ->where('article_id', $a->id)->first();

                    if (!$article) {
                        $image = Image::where('article_id', $a->id)->first();
                        $dir = "/home/krisztian/Documents/LRVL/CMS/storage/app/public/" . $image->storage;
                        Image::where('article_id', $a->id)->delete();
                        ArticleController::rmdir_recursive($dir);
                        // Delete the article
                        Article::where('id', $a->id)->delete();
                    }
                }
            }
        }
        // Finally delete the page
        Page::where('id', $id)->delete();

        return response()->json(['delete' => 'success']);
    }

    // Order the pages in the FancyTree
    public function pageOrder(Request $request) {
        $array = $request['array'];

        foreach ($array as $key => $id) {
            $id =  ltrim($id,'p#');
          $page = Page::findOrFail($id);

          if ($page) {
            $page->order_no = $key + 1;
            $page->save();
          }
        }
        return response()->json(['order' => 'success']);
    }

    // If the page is checked in the FancyTree that means that it is online
    public function onlineToggle(Request $request) {
        $id = ltrim($request->input('id'),'p#');

        $page = Page::findOrFail($id);

        if($page) {
            if($page->online == 0) {
                $page->online = 1;
                $page->save();
                return response()->json(['messgage' => 'OKS']);
            } else {
                $page->online = 0;
                $page->save();
                return response()->json(['messgage' => 'OK']);
            }
        }else  {
            return response()->json(['message' => 'No page with this id']);
        }
    }

}
