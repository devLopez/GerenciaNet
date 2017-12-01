<?php

namespace Igrejanet\GerenciaNet\Methods;

use Igrejanet\GerenciaNet\Contracts\CustomerContract;
use Igrejanet\GerenciaNet\Contracts\Payable;

/**
 * PaymentMethod
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   30/11/2017
 * @package Igrejanet\GerenciaNet\Methods
 */
abstract class PaymentMethod implements Payable
{
    /**
     * @var array
     */
    protected $customer;

    /**
     * @var array
     */
    protected $discount;

    /**
     * @return  array
     */
    public abstract function getPaymentRequest() : array;

    /**
     * @param   CustomerContract  $customer
     * @return  $this
     */
    public function setCustomer(CustomerContract $customer)
    {
        $this->customer = $customer->serialize();

        return $this;
    }

    /**
     * @param   DiscountManager  $discount
     * @return  $this
     */
    public function setDiscount(DiscountManager $discount)
    {
        $this->discount = $discount->serialize();

        return $this;
    }
}