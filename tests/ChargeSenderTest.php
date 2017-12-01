<?php

namespace Tests;

use Carbon\Carbon;
use Igrejanet\GerenciaNet\ChargeSender;
use Igrejanet\GerenciaNet\Methods\BankingBillet;
use PHPUnit\Framework\TestCase;

class ChargeSenderTest extends TestCase
{
    use Dependencies;

    public function testChargeSender()
    {
        $charge_id      = $this->createChargeId();
        $gerencianet    = $this->getGerencianet();

        $customer   = $this->getCustomer();
        $discount   = $this->getDiscount();

        $banking_billet = new BankingBillet();
        $banking_billet->setCustomer($customer);
        $banking_billet->setExpirationDate(7);
        $banking_billet->setDiscount($discount);

        $paymentSender = new ChargeSender($gerencianet);

        $response = $paymentSender->sendPaymentRequest($banking_billet, $charge_id);

        $this->assertInstanceOf(ChargeSender::class, $paymentSender);
        $this->assertArraySubset([
            'charge_id' => $charge_id,
            'expire_at' => Carbon::now()->addDays(7)->format('Y-m-d')
        ], $response);
    }
}