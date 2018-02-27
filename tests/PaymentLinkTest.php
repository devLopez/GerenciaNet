<?php

namespace Tests;

use Carbon\Carbon;
use Igrejanet\GerenciaNet\Contracts\Arrayable;
use Igrejanet\GerenciaNet\Methods\PaymentLink;
use PHPUnit\Framework\TestCase;

class PaymentLinkTest extends TestCase
{
    /**
     * @test
     * @throws
     */
    public function create_full_payment_link()
    {
        $date = Carbon::now()->addDays(7);

        $paymentLink = new PaymentLink(
            $date,
            'credit_card',
            10.00,
            7.00,
            false,
            'Favor pagar até o vencimento'
        );

        $data = $paymentLink->serialize();

        $this->assertInstanceOf(PaymentLink::class, $paymentLink);
        $this->assertInstanceOf(Arrayable::class, $paymentLink);
        $this->assertInternalType('int', $data['billet_discount']);
        $this->assertInternalType('int', $data['card_discount']);
        $this->assertInternalType('string', $data['message']);
        $this->assertInternalType('bool', $data['request_delivery_address']);
        $this->assertEquals($date->format('Y-m-d'), $data['expire_at']);
        $this->assertEquals('credit_card', $data['payment_method']);
    }

    /**
     * @test
     * @throws
     */
    public function create_partial_link()
    {
        $date = Carbon::now()->addDays(7);

        $paymentLink = new PaymentLink($date);

        $data = $paymentLink->serialize();

        $this->assertInstanceOf(PaymentLink::class, $paymentLink);
        $this->assertInstanceOf(Arrayable::class, $paymentLink);
        $this->assertArrayNotHasKey('message', $data);
        $this->assertArrayNotHasKey('billet_discount', $data);
        $this->assertArrayNotHasKey('card_discount', $data);
        $this->assertInternalType('bool', $data['request_delivery_address']);
        $this->assertEquals($date->format('Y-m-d'), $data['expire_at']);
        $this->assertEquals('all', $data['payment_method']);
    }
}
