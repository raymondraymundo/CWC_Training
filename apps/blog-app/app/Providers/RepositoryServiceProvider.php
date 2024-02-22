<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\User\UserRepositoryInterface',
            'App\Repositories\User\UserRepository'
        );

        $this->app->bind(
            'App\Repositories\ArticleCategory\ArticleCategoryRepositoryInterface',
            'App\Repositories\ArticleCategory\ArticleCategoryRepository'
        );

        $this->app->bind(
            'App\Repositories\Article\ArticleRepositoryInterface',
            'App\Repositories\Article\ArticleRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
