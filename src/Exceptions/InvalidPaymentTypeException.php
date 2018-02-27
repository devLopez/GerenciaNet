<?php

namespace Igrejanet\GerenciaNet\Exceptions;

use Exception;

/**
 * InvalidPaymentTypeException
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   27/02/2018
 * @package Igrejanet\GerenciaNet\Exceptions
 */
class InvalidPaymentTypeException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'The payment method is invalid';
}