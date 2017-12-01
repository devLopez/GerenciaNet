<?php

namespace Igrejanet\GerenciaNet;

/**
 * Sanitizable
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   01/12/2017
 * @package Igrejanet\GerenciaNet\Methods
 */
trait Sanitizable
{
    /**
     * @param   string|int  $expression
     * @param   bool  $asString
     * @return  int|string
     */
    public function onlyNumbers($expression, $asString = false)
    {
        $expression = preg_replace('/[^0-9]/', "", $expression);

        return ( ! $asString) ? (int) $expression : (string) $expression;
    }
}