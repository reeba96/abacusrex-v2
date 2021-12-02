<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    public static function getMenu() {
        $menu = Menu::all();
        return $menu;
    }
}
