<?php

namespace App\Providers;

use App\Interfaces\IPostRepo;
use App\Interfaces\IUserRepo;
use App\Repos\PostRepo;
use App\Repos\UserRepo;
use Illuminate\Support\ServiceProvider;

class RepoProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            IUserRepo::class,
            UserRepo::class
        );

        $this->app->bind(
            IPostRepo::class,
            PostRepo::class
        );
    }
}
