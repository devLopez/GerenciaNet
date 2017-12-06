<?php

namespace Igrejanet\GerenciaNet\ServiceProviders;

use Gerencianet\Gerencianet;
use Igrejanet\GerenciaNet\Igrejanet;
use Illuminate\Support\ServiceProvider;

/**
 * GerencianetServiceProvider
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.1
 * @since   06/12/2017
 * @package Igrejanet\Igrejanet\ServiceProviders
 */
class GerencianetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../resources/gerencianet.php' => config_path('gerencianet.php')
        ],'config');
    }

    public function register()
    {
        $this->app->singleton(Gerencianet::class, function () {
            $options = config('gerencianet');

            return new Gerencianet($options);
        });

        $this->app->singleton(Igrejanet::class, function () {
            $account_id = config('gerencianet.account_id');
            $sandbox    = config('gerencianet.sandbox');

            return new Igrejanet($account_id, $sandbox);
        });
    }
}