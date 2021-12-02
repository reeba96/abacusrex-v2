<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Translation\Translator;
use App\JsonTranslator;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
         // Override the JSON Translator
         $this->app->extend('translator', function (Translator $translator) {
            $trans = new JsonTranslator($translator->getLoader(), $translator->getLocale());
            $trans->setFallback($translator->getFallback());
            return $trans;
        });
    }
}
