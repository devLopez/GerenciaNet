<?php

namespace Igrejanet\GerenciaNet;

use Gerencianet\Gerencianet;
use Igrejanet\GerenciaNet\Contracts\Payable;

/**
 * ChargeSender
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   30/11/2017
 * @package Igrejanet\GerenciaNet
 */
class ChargeSender
{
    /**
     * @var Gerencianet
     */
    protected $gerencianet;

    /**
     * @param   Gerencianet  $gerencianet
     */
    public function __construct(Gerencianet $gerencianet)
    {
        $this->gerencianet = $gerencianet;
    }

    /**
     * @param   Payable  $paymentMethod
     * @param   int  $charge_id
     * @return  array
     */
    public function sendPaymentRequest(Payable $paymentMethod, int $charge_id)
    {
        $params = [
            'id' => $charge_id
        ];

        $body = $paymentMethod->getPaymentRequest();

        $response = $this->gerencianet->payCharge($params, $body);

        return $response['data'];
    }
}