<?php

namespace Igrejanet\GerenciaNet\Contracts;

interface CreditCardInterface extends Payable
{
    public function setBillingAddress(BillingContract $billingAddress);
}