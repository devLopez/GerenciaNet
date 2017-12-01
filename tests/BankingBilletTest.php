<?php

namespace Tests;

use Carbon\Carbon;
use Igrejanet\GerenciaNet\Contracts\Payable;
use Igrejanet\GerenciaNet\Methods\BankingBillet;
use PHPUnit\Framework\TestCase;

class BankingBilletTest extends TestCase
{
    use Dependencies;

    public function testBankingBillet()
    {
        $customer   = $this->getCustomer();
        $discount   = $this->getDiscount();

        $expirationDate = Carbon::now()->addDays(7)->format('Y-m-d');

        $method = new BankingBillet();
        $method->setCustomer($customer);
        $method->setDiscount($discount);
        $method->setExpirationDate(7);

        $request = $method->getPaymentRequest();

        $this->assertInstanceOf(Payable::class, $method);
        $this->assertInternalType('array', $request);
        $this->assertArraySubset([
            'payment' => [
                'banking_billet' => [
                    'expire_at' => $expirationDate
                ]
            ]
        ], $request);
    }
}