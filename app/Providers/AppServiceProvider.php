<?php

namespace App\Providers;

use App\Repository\Api\MemberRepositoryInterface;
use App\Repository\Eloquent\MemberRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MemberRepositoryInterface::class,MemberRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
