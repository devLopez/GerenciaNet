<?php

namespace Igrejanet\GerenciaNet\Contracts;

use Igrejanet\GerenciaNet\Methods\DiscountManager;

/**
 * Payable
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   29/11/2017
 * @package Igrejanet\GerenciaNet\Contracts
 */
interface Payable
{
    public function setCustomer(CustomerContract $customer);

    public function getPaymentRequest() : array;

    public function setDiscount(DiscountManager $discount);
}