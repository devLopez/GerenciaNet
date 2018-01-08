<?php

namespace Igrejanet\GerenciaNet\Methods;

use Igrejanet\GerenciaNet\Contracts\BillingContract;
use Igrejanet\GerenciaNet\Contracts\CreditCardInterface;

/**
 * CreditCard
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.1
 * @since   08/01/2018
 * @package Igrejanet\GerenciaNet\Methods
 */
class CreditCard extends PaymentMethod implements CreditCardInterface
{
    /**
     * @var int
     */
    protected $installments;

    /**
     * @var string
     */
    protected $payment_token;

    /**
     * @var array
     */
    protected $billing_address;

    /**
     * @param   string  $paymentToken
     * @param   int  $installments
     */
    public function __construct(string $paymentToken, int $installments)
    {
        $this->payment_token    = $paymentToken;
        $this->installments     = $installments;
    }

    /**
     * @param   BillingContract  $billingAddress
     * @return  $this
     */
    public function setBillingAddress(BillingContract $billingAddress)
    {
        $this->billing_address = $billingAddress->serialize();

        return $this;
    }

    /**
     * @return  array
     */
    public function getPaymentRequest() : array
    {
        $paymentRequest = [
            'payment'   => [
                'credit_card' => [
                    'installments'      => $this->installments,
                    'payment_token'     => $this->payment_token,
                    'billing_address'   => $this->billing_address,
                    'customer'          => $this->customer
                ]
            ]
        ];

        if($this->discount) {
            $paymentRequest['payment']['credit_card']['discount'] = $this->discount;
        }

        return $paymentRequest;
    }
}