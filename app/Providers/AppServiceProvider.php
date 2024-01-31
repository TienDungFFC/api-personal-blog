<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\PersonalAccessToken;
use Illuminate\Foundation\AliasLoader;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $loader = AliasLoader::getInstance();
        $loader->alias(\Laravel\Sanctum\PersonalAccessToken::class, PersonalAccessToken::class);
    }
}
