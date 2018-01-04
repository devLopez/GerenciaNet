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
        $this->assertArrayHasKey('birth', $serialization);
    }

    public function testJuridicalPerson()
    {
        $customer = new Customer(
            'Moura & Moura',
            '11254692000100',
            'comercial@mouraemoura.com',
            '3836904800',
            '',
            true
        );

        $serialization = $customer->serialize();

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertInstanceOf(CustomerContract::class, $customer);
        $this->assertArrayHasKey('juridical_person', $serialization);
        $this->assertArrayHasKey('corporate_name', $serialization['juridical_person']);
        $this->assertArrayHasKey('cnpj', $serialization['juridical_person']);
        $this->assertArrayNotHasKey('birth', $serialization);
    }
}