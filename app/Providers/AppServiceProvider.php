<?php

namespace App\Providers;

use App\Repositories\DeliveryRepository;
use App\Repositories\IDeliveryRepository;
use App\Repositories\IRouteRepository;
use App\Repositories\RouteRepository;
use App\Services\DeliveryService;
use App\Services\IDeliveryService;
use App\Services\IRouteService;
use App\Services\RouteService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IDeliveryService::class,DeliveryService::class);
        $this->app->bind(IDeliveryRepository::class,DeliveryRepository::class);
        $this->app->bind(IRouteService::class,RouteService::class);
        $this->app->bind(IRouteRepository::class,RouteRepository::class);
    }
}
