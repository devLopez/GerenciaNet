<?php

namespace Igrejanet\GerenciaNet;

use Igrejanet\GerenciaNet\Contracts\ProductsContract;
use Illuminate\Support\Collection;

/**
 * Products
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   29/11/2017
 * @package Igrejanet\GerenciaNet
 */
class Products implements ProductsContract
{
    /**
     * @var Collection
     */
    protected $items;

    public function __construct()
    {
        $this->items = new Collection();
    }

    /**
     * @param   string  $name
     * @param   int  $value
     * @param   int  $amount
     * @return  $this
     */
    public function add(string $name, int $value, int $amount = 1)
    {
        $this->items->push([
            'name'      => $name,
            'amount'    => $amount,
            'value'     => $value
        ]);

        return $this;
    }

    /**
     * @param   Collection  $products
     */
    public function addBatch(Collection $products)
    {

        $products->map(function($item){

            if(array_key_exists('name', $item) && array_key_exists('price', $item)) {

                $name   = $item['name'];
                $price  = (int) $item['price'];
                $amount = (isset($item['amount'])) ? (int) $item['amount'] : 1;

                $this->add($name, $price, $amount);
            }
        });
    }

    /**
     * @return  array
     */
    public function retrieveProducts() : array
    {
        return $this->items->toArray();
    }
}