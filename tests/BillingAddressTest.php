<?php

use Igrejanet\GerenciaNet\Contracts\BillingContract;
use Igrejanet\GerenciaNet\Customer\BillingAddress;
use PHPUnit\Framework\TestCase;

class BillingAddressTest extends TestCase
{
    public function testInstanceOfBillingAddress()
    {
        $billing = new BillingAddress(
            'Rua do Cachorro Toco',
            120,
            'Bairro São Sebastião',
            '39400000',
            'Montes Claros',
            'MG'
        );

        $this->assertInstanceOf(BillingAddress::class, $billing);
        $this->assertInstanceOf(BillingContract::class, $billing);
    }
}