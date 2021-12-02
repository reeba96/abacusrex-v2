<?php

namespace Modules\Admin\Entities;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use \Spatie\Tags\HasTags;

    protected $guarded = [];

    // Relationship with model Page
    public function pages() {
        return $this->belongsToMany(Page::class)->withPivot('published');
    }

    // Relationship with model Media
    public function medias() {
        return $this->hasMany(Media::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }

    public static function getArticles() {
        $articles = Article::all();
        return $articles;
    }

    public static function getVisibleArticle($page_id, $url) {
        $today = Carbon::now();

        $locale = app()->getLocale();

        $url_lg = 'url_'.$locale;

        $article = Article::where($url_lg,$url)
                            ->where(function ($query) use ($today) {
                                $query->where('start_date', '<=', $today)
                                    ->orWhereNull('start_date');
                            })
                            ->where(function ($query) use ($today) {
                                $query->where('end_date', '>=', $today)
                                    ->orWhereNull('end_date');
                            })->first();
                          
        if ($article){
            $pivot = DB::table('article_page')->where('page_id', $page_id)
                                        ->where('article_id',$article->id)
                                        ->where('published', 1)->get();
        }

        
        if ( $article && $pivot )
            return $article;
        else    
            return false;
    }

    public static function getVisibleArticleByUrl($page_url, $url) {
        $today = Carbon::now();

        $locale = app()->getLocale();

        $url_lg = 'url_'.$locale;

        $page= Page::where($url_lg,$page_url)->first();
        if (!$page){
            return false;
        }
        $page_id = $page->id;

        $article = Article::where($url_lg,$url)
                            ->where(function ($query) use ($today) {
                                $query->where('start_date', '<=', $today)
                                    ->orWhereNull('start_date');
                            })
                            ->where(function ($query) use ($today) {
                                $query->where('end_date', '>=', $today)
                                    ->orWhereNull('end_date');
                            })->first();
                          
        if ($article){
            $pivot = DB::table('article_page')->where('page_id', $page_id)
                                        ->where('article_id',$article->id)
                                        ->where('published', 1)->get();
        }

        
        if ( $article && $pivot )
            return $article;
        else    
            return false;
    }

    public static function search($text,$permissions = []) {

        $today = Carbon::now();

        $locale = app()->getLocale();

        $title = 'title_'.$locale;
        $content = 'content_'.$locale;
       

        $article_query = Article::where(function ($query) use ($title, $content,$text) {
                                $query->where('articles.'.$title,'like','%'.$text.'%')
                                    ->orWhere('articles.'.$content,'like','%'.$text.'%');
                            })
                            ->where(function ($query) use ($today) {
                                $query->where('articles.start_date', '<=', $today)
                                    ->orWhereNull('articles.start_date');
                            })
                            ->where(function ($query) use ($today) {
                                $query->where('articles.end_date', '>=', $today)
                                    ->orWhereNull('articles.end_date');
                            });
        $article_query->join('article_page','article_page.article_id','=','articles.id')->where('article_page.published', 1);    


        $article_query->join('pages', function($join) use($permissions) {
            $join->on('pages.id', '=', 'article_page.page_id')->whereIn('pages.permission_id', $permissions);
        })->select('pages.'.$title.' as pages.page_title');
        dump(Article::prepareQuery($article_query));
        return $article_query;
  
    }

    /**
     * Query Builderből biztonságos SQL scriptet készít
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return string
     */
    public static function prepareQuery($query)
    {
        $sql = $query->toSql();
        foreach ($query->getBindings() as $binding) {
            $value = is_numeric($binding) ? $binding : "'" . str_replace("'", "''", $binding) . "'";
            
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }
        return $sql;
    }
}
