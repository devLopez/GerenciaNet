<?php

namespace Tests;

use Igrejanet\GerenciaNet\Igrejanet;
use PHPUnit\Framework\TestCase;

class IgrejanetTest extends TestCase
{
    public function testJavascriptPrint()
    {
        $account_id = getenv('GERENCIANET_ACCOUNT_ID');

        $javascript = new Igrejanet($account_id, true);

        $this->assertInternalType('string', $javascript->generateScript());
    }
}
