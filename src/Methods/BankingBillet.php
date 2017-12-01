<?php

namespace Igrejanet\GerenciaNet\Methods;

use Carbon\Carbon;

/**
 * BankingBillet
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   30/11/2017
 * @package Igrejanet\GerenciaNet\Methods
 */
class BankingBillet extends PaymentMethod
{
    /**
     * @var string
     */
    protected $expire_at;

    /**
     * @param   int  $days
     */
    public function setExpirationDate(int $days)
    {
        $this->expire_at = Carbon::now()->addDays($days)->format('Y-m-d');
    }

    /**
     * @return array
     */
    public function getPaymentRequest() : array
    {
        $paymentRequest = [
            'payment' => [
                'banking_billet' => [
                    'expire_at' => $this->expire_at,
                    'customer'  => $this->customer,
                ]
            ]
        ];

        if($this->discount) {
            $paymentRequest['payment']['banking_billet']['discount'] = $this->discount;
        }

        return $paymentRequest;
    }
}