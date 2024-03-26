<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\ShortUrl\ShortUrlService;
use App\Services\ShortUrl\ShortUrlServiceInterface;
use App\Services\ShortUrl\Repositories\ShortUrlRepository;
use App\Services\ShortUrl\Repositories\ShortUrlRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ShortUrlServiceInterface::class, ShortUrlService::class);
        $this->app->bind(ShortUrlRepositoryInterface::class, ShortUrlRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
