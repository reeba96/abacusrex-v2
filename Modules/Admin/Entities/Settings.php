<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
   
    protected $fillable = [
        'name', 'content', 'enabled', 'type','expires_at'
    ];
   
    public static function getOnlineSettings() {
        $settings = Settings::where('enabled', true)->get();
        return $settings;
   }
}
