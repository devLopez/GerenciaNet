<?php

namespace Tests;

use Igrejanet\GerenciaNet\Contracts\CreditCardInterface;
use Igrejanet\GerenciaNet\Methods\CreditCard;
use PHPUnit\Framework\TestCase;

class CreditCardTest extends TestCase
{
    use Dependencies;

    public function testCreditCard()
    {
        $customer       = $this->getCustomer();
        $billingAddress = $this->getBillingAddress();
        $discount       = $this->getDiscount();

        $method = new CreditCard('alkajsdçlkajslfij35216a54sd', 1);
        $method->setCustomer($customer);
        $method->setBillingAddress($billingAddress);
        $method->setDiscount($discount);

        $paymentRequest = $method->getPaymentRequest();

        $this->assertInstanceOf(CreditCardInterface::class, $method);
        $this->assertInternalType('array', $paymentRequest);
        $this->assertArraySubset([
            'payment' => [
                'credit_card' => [
                    'installments' => 1
                ]
            ]
        ], $paymentRequest);
    }
}