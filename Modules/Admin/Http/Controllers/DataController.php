<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Page;

class DataController extends Controller
{
    public function getJSONtree($id_parent = 0) {
        // Get the data for displaying FancyTree. Example below..
        $locale = app()->getLocale();
        $title = 'title_' . $locale;
        $list = [];
        $pages = Page::where('parent_id', $id_parent)->orderBy('order_no')->get();

        foreach ($pages as $page) {
           $page_children = $this->getJSONtree($page->id);
            
           $children = [];
           
           $item['title'] = $page->$title;
           if( !empty($page->module_name) )
               $item['title'] = $page->$title;
           $item['key'] = 'p#'.$page->id;
           $item['folder'] = true;
           $item['selected'] = $page->online;
           $page_articles = $page->articles()->orderBy('order_no')->get();

           foreach( $page_articles as $page_article) {
               $childrens['title'] = $page_article->$title;
               $childrens['key'] = $page_article->pivot->article_id;
               $childrens['selected'] = $page_article->pivot->published;
               $children[] = $childrens;
           }

           $item['children'] = array_merge($page_children, $children);
           $list[] = $item;
        }
        
        return $list;
    }
}


/******************** FancyTree JSON Data Example ******************************

[
    {
      "title": "Home",
      "key": 8,
      "folder": true,
      "selected": 1,
      "children": [
                      {
                      "title": "Home Blog",
                      "key": 458,
                      "selected": 0
                      },
                      {
                      "title": "Home Gallery",
                      "key": 459,
                      "selected": 0
                      }
                  ]
    },
    {
      "title": "footer",
      "key": 1,
      "folder": true,
      "selected": 1,
      "children": [
                      {
                      "title": "footer",
                      "key": 444,
                      "selected": 1
                      }
                  ]
    },
    {
      "title": "Gallery",
      "key": 2,
      "folder": true,
      "selected": 1,
      "children": [
                      {
                      "title": "Gallery",
                      "key": 456,
                      "selected": 1
                      },
                      {
                      "title": "Gallery 2",
                      "key": 460,
                      "selected": 1
                      }
                  ]
    }
]
********************************************************************************/
