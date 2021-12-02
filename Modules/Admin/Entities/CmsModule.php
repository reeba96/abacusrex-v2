<?php

namespace Modules\Admin\Entities;
use Illuminate\Database\Eloquent\Model;

class CmsModule extends Model
{
    protected $fillable = ['name',
                            'description',
                            'config_file',
                            'is_installed',
                            'version',
                            'page_top',
                            'page_tab',
                            'page_content',
                            'article_top',
                            'article_tab',
                            'article_content',
                            'main_menu'];
                            
    protected $table = 'modules';
    
    public static function getAll() {
        return $modules = CmsModule::all();
    }
    
    public static function getInstalled() {
        return $modules = CmsModule::where('is_installed','=', 1)->get();
    }
}
