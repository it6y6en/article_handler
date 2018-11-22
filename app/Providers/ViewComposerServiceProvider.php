<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Article;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.nav', function($view)
        {
            $view->with('latest', Article::latest()->first());
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
