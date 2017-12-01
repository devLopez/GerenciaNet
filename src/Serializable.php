<?php

namespace Igrejanet\GerenciaNet;

/**
 * Serializable
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   29/11/2017
 * @package Igrejanet\GerenciaNet
 */
trait Serializable
{
    /**
     * @return  array
     */
    public function serialize()
    {
        return get_object_vars($this);
    }
}