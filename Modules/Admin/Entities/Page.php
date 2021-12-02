<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Page extends Model
{
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles() {
        return $this->belongsToMany(Article::class)->withPivot('published');
    }

    public static function getPages() {
        $pages = Page::all();
        return $pages;
    }

    public function qrCodeGen()
    {
        return $this->hasOne(QrCodeGen::class);
    }

    public function getVisibleArticles() {
        $today = Carbon::now();

        return $this->belongsToMany(Article::class)
                    ->withPivot('published')
                    ->where('published', 1)
                    ->where(function ($query) use ($today) {
                        $query->where('start_date', '<=', $today)
                            ->orWhereNull('start_date');
                    })
                    ->where(function ($query) use ($today) {
                        $query->where('end_date', '>=', $today)
                            ->orWhereNull('end_date');
                    });
    }
}
