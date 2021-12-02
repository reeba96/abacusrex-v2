<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Entities\Article;
use Modules\Admin\Entities\Media;
use Modules\Admin\Entities\Image;
use Modules\Admin\Entities\Page;
use Nwidart\Modules\Facades\Module;


/*******************************************************************************

********************************************************************************/

class ArticleController extends Controller
{
    
    public function edit(Request $request) {

        $languages = \LaravelLocalization::getSupportedLocales();
        $language_keys = array_keys($languages);
        
        $installed_modules = [];//Module::all();
        $page_id = ltrim($request->input('page_id'),'p#');
      
        $article_id = $request->input('article_id');
        
        if ($article_id){
            $article = Article::find($article_id);
            $all_media = $article->medias()
                          ->orderBy('order_no')
                          ->get();
            
        }
        else{
            $article = new Article;
            $all_media = NULL;

            
        }
        $article_views = config('theme.article_views');

        $enabled_modules = Module::getByStatus(1);

        //dump($enabled_modules);
      //  dump($article->tagsTranslated()->get()->pluck('name'));
       
       // dump($article_tags);
        return view('admin::admin.article-form', compact(['article', 'page_id', 'all_media','installed_modules', 'enabled_modules', 'article_views','languages','language_keys']));
        //return view('admin::admin.article-form', compact('page_id'));
    }
    

    public function link(Request $request) {

        $page_id = ltrim($request->input('page_id'),'p#');
        DB::table('article_page')->insert([
            'page_id' => $page_id, 
            'article_id' => $request->input('article_id')
        ]);

        return json_encode('OK');

    }

    public function unlink(Request $request) {

        $page_id = ltrim($request->input('page_id'),'p#');

        DB::table('article_page')->where( 'page_id',$page_id)
                                 ->where( 'article_id',$request->input('article_id'))   
                                ->delete();

        return json_encode('OK');

    }

    public function refresh_pages_list(Request $request){

        $article_id = $request->input('article_id');
       
        $article = Article::find($article_id);
        \Log::notice(['article' => $article]);
        $pages = $article->pages()->get();
        
        return view('admin::admin.article_linked_pages_list', compact(['article', 'pages']));
    }

    public function store(Request $request) {
      /* Create new article, store in DB */

        $user_id = auth()->user()->id;
        

      /*  if ($request['archive'] == 'on') {
            $archive = 1;
        } else { $archive = 0; }

        $article_id = DB::table('articles')->insertGetId([
            'user_id' => $user_id,
            'name' => $request['title_en'],
            'title_hu' => $request['title_hu'],
            'title_sr' => $request['title_sr'],
            'title_en' => $request['title_en'],
            'subtitle_hu' => $request['subtitle_hu'],
            'subtitle_sr' => $request['subtitle_sr'],
            'subtitle_en' => $request['subtitle_en'],
            'content_en' => $request['content_en'],
            'content_hu' => $request['content_hu'],
            'content_sr' => $request['content_sr'],
            'description_hu' => $request['description_hu'],
            'description_sr' => $request['description_sr'],
            'description_en' => $request['description_en'],
            'url_en' => $request['url_en'],
            'url_sr' => $request['url_sr'],
            'url_hu' => $request['url_hu'],
            'author_en' => $request['author_en'],
            'author_hu' => $request['author_hu'],
            'author_sr' => $request['author_sr'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'archive' => $archive,
            'order_no' => 999,
            'view' => $request['view']
        ]);*/

            $data = $request->all();
            unset($data['page_id']);
            unset($data['published']);
            $data['order_no'] = 999;
            $data['user_id'] = $user_id;

            $languages = \LaravelLocalization::getSupportedLocales();
            $language_keys = array_keys($languages);
            foreach ($language_keys as $key => $code){
                    unset($data['auto_'.$code]);
            }

            $article = Article::create($data);

            /* Add parent realtionship */
            DB::table('article_page')->insert([
                'page_id' => $request->input('page_id'), 
                'article_id' => $article->id,
                'published' => $request->input('published',0)
            ]);

            //syncing tags
            if ( isset($request['tags']) ){

                $syncTags = [];
                foreach( $request['tags'] as $key => $tag){
                    $syncTags[] = $tag;
                }
                $article->syncTagsWithType($syncTags,'article');
                unset($data['tags']);
            }

            return redirect()->back()->with('status', 'Article saved!');
    }

    public function update(Request $request, $id) {

        $article = Article::findOrFail($id);
        
//      $article->update($request->all()); =>  nem mukodik mert beleveszi a file-t is, 
//      except('file') ok, de ha archive vagy sharethis valtozik akkor nem tudja 
//      az on-t ertelmezni

     
       $data = $request->all();
       
       unset($data['qqfile']);

       $languages = \LaravelLocalization::getSupportedLocales();
       $language_keys = array_keys($languages);
       foreach ($language_keys as $key => $code){
            unset($data['auto_'.$code]);
       }


       if ($request['archive'] == 'on') {
           $data['archive'] = 1;
       } 
       else { 
           $data['archive'] = 0; 
       }

       //syncing tags
        if ( isset($request['tags']) ){

            $syncTags = [];
            foreach( $request['tags'] as $key => $tag){
                $syncTags[] = $tag;
            }
            $article->syncTagsWithType($syncTags,'article');
            unset($data['tags']);
        }
        unset($data['page_id']);

        $article->update($data);

       /* $article->start_date = $request['start_date'];
        $article->end_date = $request['end_date'];
        $article->view = $request['view'];
        $article->title_en = $request['title_en'];
        $article->title_sr = $request['title_sr'];
        $article->title_hu = $request['title_hu'];
        $article->subtitle_en = $request['subtitle_en'];
        $article->subtitle_sr = $request['subtitle_sr'];
        $article->subtitle_hu = $request['subtitle_hu'];
        $article->url_en = $request['url_en'];
        $article->url_sr = $request['url_sr'];
        $article->url_hu = $request['url_hu'];
        $article->content_en = $request['content_en'];
        $article->content_sr = $request['content_sr'];
        $article->content_hu = $request['content_hu'];
        $article->author_en = $request['author_en'];
        $article->author_sr = $request['author_sr'];
        $article->author_hu = $request['author_hu'];

        if ($request['archive'] == 'on') {
            $article->archive = 1;
        } else { $article->archive = 0; }

        $article->save();*/

        return redirect()->back()->with('status', 'Article updated!');
    }

    public function destroy(Request $request) {
        // Delete article
        $article_id = $request['id'];
        $page_id = $request['parent'];

        // First, delete the realtionship between the Page and the Article
        DB::table('article_page')
                ->where('article_id', $article_id)
                ->where('page_id', $page_id)
                ->delete();

        // Maybe article duplicated, it can be a relationship with another page
        $article = DB::table('article_page')->where('article_id', $article_id)->first();

        // If there is no more article in pivot table, that means that the article is unsued
        // so we can search for it's images and delete them
        if (! $article) {
            $image = Media::where('article_id', $article_id)->first();

            if ($image) {
                Media::where('article_id', $article_id)->delete();
                $dir = storage_path('app/public/') . $image->storage;

                // Recursively delete pictures of deleted article
                $this->rmdir_recursive($dir);
            }
            // Finally delete the article too
            Article::where('id', $article_id)->delete();
        }
        return response()->json(['delete' => 'success']);
    }

    public function articleOrder(Request $request) {
        // Order the articles in the FancyTree
        $array = $request['array'];

        foreach ($array as $ $key => $id) {
            $article = Article::findOrFail($id);

            if ($article) {
              $article->order_no = $key + 1;
              $article->save();
            }
        }
        return response()->json(['order' => 'success']);
    }

    public function fileUpdate(Request $request) {
      // Update article's image/file (titles and appearing)
      $id = $request['media_id'];
      $media = Media::findOrFail($id);

        if ($request['file_appears_en'] == 'on') {
           $appears_en = 1;
        } else { $appears_en = 0; }

        if ($request['file_appears_hu'] == 'on') {
           $appears_hu = 1;
        } else { $appears_hu = 0; }

        if ($request['file_appears_sr'] == 'on') {
           $appears_sr = 1;
        } else { $appears_sr = 0; }

          $media->update([
            'title_en' => $request['file_title_en'],
            'title_hu' => $request['file_title_hu'],
            'title_sr' => $request['file_title_sr'],
            'appears_en' => $appears_en,
            'appears_hu' => $appears_hu,
            'appears_sr' => $appears_sr,
          ]);
      return response()->json(['message' => 'success']);
    }

    // If the article is checked in the FancyTree that means that it is published
    public function publishToggle(Request $request) {
        $id = $request['id'];
        $parent = ltrim($request->input('parent'),'p#'); 

        $article = DB::table('article_page')->where('article_id', $id)->where('page_id', $parent)->first();
        if ($article) {
            if ($article->published == 0) {
                DB::table('article_page')->where('article_id', $id)->where('page_id', $parent)->update([
                    'published' => 1
                ]);
                return response()->json(['message' => 'OK']);
            } else {
               DB::table('article_page')->where('article_id', $id)->where('page_id', $parent)->update([
                    'published' => 0
                ]);
                return response()->json(['message' => 'OK']);
            }
        } else {
            return response()->json(['message' => 'No article with this id']);
        }
    }

    public static function rmdir_recursive($dir) {
        // Function for deleting directiories recursively. Used when delete an image below an article
        // and if it was the last image in that folder, we can delete the folder too
        foreach(scandir($dir) as $file) {
            if ('.' === $file || '..' === $file) continue;
            if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
            else unlink("$dir/$file");
        }
        rmdir($dir);
    }


   // public static function remove_parent
}
