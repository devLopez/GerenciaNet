<?php

namespace Igrejanet\GerenciaNet\Methods;

use Carbon\Carbon;
use Igrejanet\GerenciaNet\Contracts\Arrayable;
use Igrejanet\GerenciaNet\Exceptions\InvalidPaymentTypeException;

/**
 * PaymentLink
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   27/02/2018
 * @package Igrejanet\GerenciaNet\Methods
 */
class PaymentLink implements Arrayable
{
    /**
     * @var int
     */
    protected $billet_discount;

    /**
     * @var int
     */
    protected $card_discount;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $expire_at;

    /**
     * @var bool
     */
    protected $request_delivery_address;

    /**
     * @var string
     */
    protected $payment_method;

    /**
     * @param   Carbon  $expireAt
     * @param   string  $paymentMethod
     * @param   float|null  $billetDiscount
     * @param   float|null  $cardDiscount
     * @param   bool  $requestDeliveryAddress
     * @param   string  $message
     * @throws  InvalidPaymentTypeException
     */
    public function __construct(
        Carbon $expireAt,
        $paymentMethod = 'all',
        $billetDiscount = null,
        $cardDiscount = null,
        bool $requestDeliveryAddress = false,
        string $message = null
    )
    {
        $this->expire_at                = $expireAt->format('Y-m-d');
        $this->payment_method           = $paymentMethod;
        $this->billet_discount          = $this->toInteger($billetDiscount);
        $this->card_discount            = $this->toInteger($cardDiscount);
        $this->request_delivery_address = $requestDeliveryAddress;
        $this->message                  = $message;

        $this->checkPaymentMethod();
    }

    /**
     * @return  array
     */
    public function serialize() : array
    {
        $vars = get_object_vars($this);

        return array_filter($vars, function($value) {
            return ($value !== null && $value !== '');
        });
    }

    /**
     * @return int
     */
    public function getBilletDiscount()
    {
        return $this->billet_discount;
    }

    /**
     * @param   float|int  $billet_discount
     * @return  $this
     */
    public function setBilletDiscount($billet_discount)
    {
        $this->billet_discount = $this->toInteger($billet_discount);

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCardDiscount()
    {
        return $this->card_discount;
    }

    /**
     * @param   float|int  $card_discount
     * @return  $this;
     */
    public function setCardDiscount($card_discount)
    {
        $this->card_discount = $this->toInteger($card_discount);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param   string  $message
     * @return  $this
     */
    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return  string
     */
    public function getExpireAt() : string
    {
        return $this->expire_at;
    }

    /**
     * @param   Carbon  $expireAt
     * @return  $this
     */
    public function setExpireAt(Carbon $expireAt)
    {
        $this->expire_at = $expireAt->format('Y-m-d');

        return $this;
    }

    /**
     * @return bool
     */
    public function getRequestDeliveryAddress() : bool
    {
        return $this->request_delivery_address;
    }

    /**
     * @param   bool  $request_delivery_address
     * @return  $this
     */
    public function setRequestDeliveryAddress(bool $request_delivery_address)
    {
        $this->request_delivery_address = $request_delivery_address;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentMethod() : string
    {
        return $this->payment_method;
    }

    /**
     * @param   string  $payment_method
     * @return  $this
     * @throws  InvalidPaymentTypeException
     */
    public function setPaymentMethod(string $payment_method)
    {
        $this->payment_method = $payment_method;

        $this->checkPaymentMethod();

        return $this;
    }

    /**
     * @return  bool
     * @throws  InvalidPaymentTypeException
     */
    private function checkPaymentMethod()
    {
        $methods = [
            'all',
            'banking_billet',
            'credit_card'
        ];

        if ( ! in_array($this->payment_method, $methods) ) {
            throw new InvalidPaymentTypeException();
        }

        return true;
    }

    /**
     * @param   $number
     * @return  int|null
     */
    private function toInteger($number = null)
    {
        if ( $number ) {
            return (int) ($number * 100);
        }

        return null;
    }
}