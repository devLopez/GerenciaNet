<?php

namespace Igrejanet\GerenciaNet\Contracts;

use Illuminate\Support\Collection;

/**
 * ProductsContract
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   29/11/2017
 * @package Igrejanet\GerenciaNet\Contracts
 */
interface ProductsContract
{
    public function add(string $name, int $value, int $amount = 1);

    public function addBatch(Collection $products);

    public function retrieveProducts() : array;
}