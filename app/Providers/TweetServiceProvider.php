<?php

namespace App\Providers;

use App\Contracts\TweetRepositoryInterface;
use App\Contracts\TweetServiceInterface;
use App\Repositories\TweetRepository;
use App\Services\TweetService;
use Illuminate\Support\ServiceProvider;

class TweetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(TweetServiceInterface::class,TweetService::class);
        $this->app->bind(TweetRepositoryInterface::class,TweetRepository::class);
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
