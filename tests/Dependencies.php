<?php

namespace Tests;

use Carbon\Carbon;
use Gerencianet\Gerencianet;
use Igrejanet\GerenciaNet\ChargeCreator;
use Igrejanet\GerenciaNet\Customer\BillingAddress;
use Igrejanet\GerenciaNet\Customer\Customer;
use Igrejanet\GerenciaNet\Methods\DiscountManager;
use Igrejanet\GerenciaNet\Methods\PaymentLink;
use Igrejanet\GerenciaNet\Products;

trait Dependencies
{
    /**
     * @return Customer
     */
    public function getCustomer() : Customer
    {
        return new Customer(
            'João Carmélio da Silva',
            '32214653783',
            'joao@company.com',
            '3895281420'
        );
    }

    /**
     * @return DiscountManager
     */
    public function getDiscount() : DiscountManager
    {
        return new DiscountManager(1000);
    }

    /**
     * @return Products
     */
    public function getProducts() : Products
    {
        $products = new Products();

        $products->add('Item 1', 1000);
        $products->add('Item 2', 2000, 3);

        return $products;
    }

    /**
     * @return BillingAddress
     */
    public function getBillingAddress() : BillingAddress
    {
        return new BillingAddress(
            'Rua do Cachorro Toco',
            12,
            'São Pedo da Garça',
            '39400000',
            'Montes Claros',
            'MG'
        );
    }

    /**
     * @return Gerencianet
     */
    public function getGerencianet()
    {
        return new Gerencianet([
            'client_id'     => getenv('GERENCIANET_CLIENT_ID'),
            'client_secret' => getenv('GERENCIANET_CLIENT_SECRET'),
            'sandbox'       => true
        ]);
    }

    /**
     * @return  int
     * @throws  \Exception
     */
    public function createChargeId()
    {
        $gerencianet = $this->getGerencianet();

        $chargeCreator = new ChargeCreator($gerencianet);

        $products = $this->getProducts();

        $chargeCreator->setInvoiceId(1);
        $chargeCreator->setNotificationUrl('http://www.minhaloja.com.br');
        $chargeCreator->setProducts($products);

        return $chargeCreator->generateCharge();
    }

    /**
     * @return  PaymentLink
     * @throws  \Igrejanet\GerenciaNet\Exceptions\InvalidPaymentTypeException
     */
    public function getPaymentLink()
    {
        return new PaymentLink(
            Carbon::now()->addDays(3)
        );
    }
}