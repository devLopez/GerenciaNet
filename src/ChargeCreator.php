<?php

namespace Igrejanet\GerenciaNet;

use Gerencianet\Gerencianet;
use Igrejanet\GerenciaNet\Contracts\ProductsContract;

/**
 * ChargeCreator
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   29/11/2017
 * @package Igrejanet\GerenciaNet
 */
class ChargeCreator
{
    use Serializable;

    /**
     * @var Gerencianet
     */
    protected $gerencianet;

    /**
     * @var array
     */
    protected $meta_data;

    /**
     * @var array
     */
    protected $products;

    /**
     * @param   Gerencianet  $gerencianet
     */
    public function __construct(Gerencianet $gerencianet)
    {
        $this->gerencianet = $gerencianet;
    }

    /**
     * @param   ProductsContract  $products
     */
    public function setProducts(ProductsContract $products)
    {
        $this->products = $products->retrieveProducts();
    }

    /**
     * @param   string  $invoice_id
     * @return  $this
     */
    public function setInvoiceId($invoice_id)
    {
        $this->meta_data['custom_id'] = (string) $invoice_id;

        return $this;
    }

    /**
     * @param   string  $notificationUrl
     * @return  $this
     */
    public function setNotificationUrl($notificationUrl)
    {
        $this->meta_data['notification_url'] = $notificationUrl;

        return $this;
    }

    /**
     * @return  integer
     * @throws  \Exception
     */
    public function generateCharge()
    {
        $body = $this->generateChargePayload();

        try {
            $charge_id = $this->gerencianet->createCharge([], $body);

            return $charge_id['data']['charge_id'];

        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @return array
     */
    protected function generateChargePayload()
    {
        return [
            'items'     => $this->products,
            'metadata'  => $this->meta_data
        ];
    }
}