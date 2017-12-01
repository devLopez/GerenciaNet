<?php

namespace Tests;

use Igrejanet\GerenciaNet\Products;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class ProductsTest extends TestCase
{
    public function testProductAdd()
    {
        $products = new Products();

        $products->add('Arroz', 1000, 3);
        $products->add('Chã de Fora', 22000, 1);

        $allProducts = $products->retrieveProducts();

        $this->assertInstanceOf(Products::class, $products);
        $this->assertInternalType('array', $products->retrieveProducts());
        $this->assertArraySubset([
            ['name' => 'Arroz']
        ], $allProducts);
    }

    public function testBatchInsertion()
    {
        $products = new Products();

        $products->addBatch($this->getProducts());

        $allProducts = $products->retrieveProducts();

        $this->assertArraySubset([
            ['name' => 'Arroz', 'amount' => 2]
        ], $allProducts);
    }

    public function getProducts()
    {
        return new Collection([
            ['name' => 'Arroz', 'price' => 10000, 'amount' => 2],
            ['name' => 'Chã de Fora', 'price' => 22000],
            ['amount' => 3]
        ]);
    }
}