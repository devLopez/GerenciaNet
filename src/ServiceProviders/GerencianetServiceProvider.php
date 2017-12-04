<?php

namespace Igrejanet\GerenciaNet\ServiceProviders;

use Gerencianet\Gerencianet;
use Igrejanet\GerenciaNet\Igrejanet;
use Illuminate\Support\ServiceProvider;

/**
 * GerencianetServiceProvider
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   01/12/2017
 * @package Igrejanet\Igrejanet\ServiceProviders
 */
class GerencianetServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../resources/gerencianet.php',
            'gerencianet'
        );

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