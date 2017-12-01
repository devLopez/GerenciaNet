<?php

namespace Tests;

use Igrejanet\GerenciaNet\Contracts\CustomerContract;
use Igrejanet\GerenciaNet\Customer\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    /**
     * @see https://www.geradordecpf.org/
     */
    public function testCustomerSerialization()
    {
        $customer = new Customer(
            'Matheus Lopes Santos',
            '25343235557',
            'joao@gmail.com',
            '31998401515',
            '1990-01-01'
        );

        $serialization = $customer->serialize();

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertInstanceOf(CustomerContract::class, $customer);
        $this->assertArrayHasKey('name', $serialization);
        $this->assertArrayHasKey('email', $serialization);
    }
}