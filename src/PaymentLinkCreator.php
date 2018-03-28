<?php

namespace Igrejanet\GerenciaNet;

use Gerencianet\Gerencianet;
use Igrejanet\GerenciaNet\Methods\PaymentLink;

/**
 * PaymentLinkCreator
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.1.0
 * @since   27/03/2018
 * @package Igrejanet\GerenciaNet
 */
class PaymentLinkCreator
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
     * @param   int  $chargeId
     * @param   PaymentLink  $payment
     * @param   bool  $updateLink
     * @return  mixed
     */
    public function createLink(int $chargeId, PaymentLink $payment, bool $updateLink = false)
    {
        $params = ['id' => $chargeId];
        $body   = $payment->serialize();

        if ( $updateLink ) {
            $response = $this->gerencianet->updateChargeLink($params, $body);
        } else {
            $response = $this->gerencianet->linkCharge($params, $body);
        }

        return $response['data'];
    }
}