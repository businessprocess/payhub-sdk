<?php

namespace Payhub;

use GeoService\Service\GeoService;
use Illuminate\Support\ServiceProvider;
use Payhub\Contracts\HttpClient;
use Payhub\Http\Client;
use Payhub\Support\Normalizer;

class PayhubServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/payhub.php', 'payhub');

        $this->publishes([
            __DIR__.'/../config/payhub.php' => config_path('payhub.php'),
        ]);

        $this->app->bind(HttpClient::class, function ($app) {
            return $app->make(Client::class);
        });

        $this->app->when(Client::class)
            ->needs('$config')
            ->giveConfig('payhub');

        Normalizer::setGeoService($this->app->make(GeoService::class));
    }
}
