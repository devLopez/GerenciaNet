<?php

namespace Tests;

use Gerencianet\Gerencianet;
use Igrejanet\GerenciaNet\ChargeCreator;
use PHPUnit\Framework\TestCase;

class ChargeCreatorTest extends TestCase
{
    use Dependencies;

    public function testInstanceOfChargeCreator()
    {
        $gerencianet = $this->getGerencianet();

        $chargeCreator = new ChargeCreator($gerencianet);

        $products = $this->getProducts();

        $chargeCreator->setInvoiceId(1);
        $chargeCreator->setNotificationUrl('http://www.minhaloja.com.br');
        $chargeCreator->setProducts($products);

        $charge_id = $chargeCreator->generateCharge();

        $this->assertInstanceOf(Gerencianet::class, $gerencianet);
        $this->assertInstanceOf(ChargeCreator::class, $chargeCreator);
        $this->assertInternalType('int', $charge_id);
    }
}