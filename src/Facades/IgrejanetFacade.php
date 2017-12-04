<?php

namespace Igrejanet\GerenciaNet\Facades;

use Igrejanet\GerenciaNet\Igrejanet;
use Illuminate\Support\Facades\Facade;

/**
 * IgrejanetFacade
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   04/12/2017
 * @package Igrejanet\Igrejanet\Facades
 */
class IgrejanetFacade extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return Igrejanet::class;
    }
}