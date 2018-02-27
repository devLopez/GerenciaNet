<?php

namespace Tests;

use Igrejanet\GerenciaNet\PaymentLinkCreator;
use PHPUnit\Framework\TestCase;

class PaymentLinkCreatorTest extends TestCase
{
    use Dependencies;

    /**
     * @test
     * @throws
     */
    public function create_payment_link()
    {
        $charge_id      = $this->createChargeId();
        $gerencianet    = $this->getGerencianet();
        $paymentLink    = $this->getPaymentLink();

        $creator    = new PaymentLinkCreator($gerencianet);
        $response   = $creator->createLink($charge_id, $paymentLink);

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('payment_url', $response);
    }
}
