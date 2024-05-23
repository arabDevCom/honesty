<?php

namespace App\Providers;

use App\Repository\Api\Eloquent\MemberRepository;
use App\Repository\Api\MemberRepositoryInterface;
use App\Repository\Eloquent\NewRepository;
use App\Repository\NewRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Api
        $this->app->bind(MemberRepositoryInterface::class,MemberRepository::class);

        //Dashboard

        $this->app->bind(NewRepositoryInterface::class,NewRepository::class);



    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
