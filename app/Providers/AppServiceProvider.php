<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Services\interfaces\TagRepository;
use Services\TagRepositoryImpl;
use Services\UserRepository;
use Services\UserRepositoryImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);
        $this->app->bind(TagRepository::class, TagRepositoryImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
