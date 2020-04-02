<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Apis\CommissionJunction;
use GuzzleHttp\Client;

use App\Apis\TradeDoubler;

use App\Apis\TradeTracker;
use SoapClient;

use App\Apis\Awin;

use App\Apis\Stripe\Stripe;

class APIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $config = $this->app->make('config');

        $this->app->singleton (CommissionJunction::class, function ($app) use ($config) {
            return new CommissionJunction(
                (object) $config->get('api.commission_junction'),
                new Client([
                    'headers' => ['Authorization' => "Bearer " . $config->get('api.COMMISSION_JUNCTION_TOKEN')]
                ])
            );
        });

        $this->app->singleton (TradeTracker::class, function ($app) use ($config) {
            $config = ((object) $config->get('api.tradetracker'));
            $client = (new SoapClient($config->URL, ['compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP]));
            $client->authenticate($config->CUSTOMER_ID, $config->TRADETRACKER_PASSPHRASE);

            return new TradeTracker(
                $config->TRADETRACKER_AFFILIATE_SITE_ID,
                $client
            );
        });

        $this->app->singleton (TradeDoubler::class, function ($app) use ($config) {
            return new TradeDoubler ((object) $config->get('api.tradedoubler'), new Client);
        });

        $this->app->singleton (Awin::class, function ($app) use ($config) {
            return new Awin(
                $config->get('api.awin.ACCOUNT_ID'),
                new Client([
                    'headers' => ['Authorization' => "Bearer " . $config->get('api.awin.TOKEN')]
                ])
            );
        });


        /**
         * Stripe
         */
        $this->app->singleton (Stripe::class, function ($app) use ($config) {
            return new Stripe ((object) $config->get('stripe'));
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
