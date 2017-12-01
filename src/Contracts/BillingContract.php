<?php

namespace Igrejanet\GerenciaNet\Contracts;

/**
 * BillingContract
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   29/11/2017
 * @package Igrejanet\GerenciaNet\Contracts
 */
interface BillingContract extends Arrayable
{
    public function setStreet($street);

    public function setNumber(int $number);

    public function setNeighborHood($neighborhood);

    public function setZipCode($zip);

    public function setCity($city);

    public function setState($state);
}