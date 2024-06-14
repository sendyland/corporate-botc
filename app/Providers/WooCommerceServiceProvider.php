<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\WooCommerceService;

class WooCommerceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WooCommerceService::class, function ($app) {
            return new WooCommerceService(
                config('services.woocommerce.store_url'),
                config('services.woocommerce.consumer_key'),
                config('services.woocommerce.consumer_secret')
            );
        });
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
