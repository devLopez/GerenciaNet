<?php

namespace Igrejanet\GerenciaNet\Customer;

use Igrejanet\GerenciaNet\Contracts\BillingContract;
use Igrejanet\GerenciaNet\Sanitizable;
use Igrejanet\GerenciaNet\Serializable;

/**
 * BillingAddress
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   29/11/2017
 * @package Igrejanet\GerenciaNet\Customer
 */
class BillingAddress implements BillingContract
{
    use Serializable, Sanitizable;

    /**
     * @var string
     */
    protected $street;

    /**
     * @var int
     */
    protected $number;

    /**
     * @var string
     */
    protected $complement = '';

    /**
     * @var string
     */
    protected $neighborhood;

    /**
     * @var int
     */
    protected $zipcode;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $state;

    /**
     * @param   string  $street
     * @param   int  $number
     * @param   string  $neighborhood
     * @param   string  $zip
     * @param   string  $city
     * @param   string  $state
     * @param   string  $complement
     */
    public function __construct($street, int $number, $neighborhood, $zip, $city, $state, $complement = '')
    {
        $this->street       = $street;
        $this->number       = $number;
        $this->complement   = $complement;
        $this->neighborhood = $neighborhood;
        $this->zipcode      = $this->onlyNumbers($zip, true);
        $this->city         = $city;
        $this->state        = $state;
    }

    /**
     * @param   string  $street
     * @return  $this
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @param   int  $number
     * @return  $this
     */
    public function setNumber(int $number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @param   string  $complement
     * @return  $this
     */
    public function setComplement(string $complement)
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * @param   string  $neighborhood
     * @return  $this
     */
    public function setNeighborhood($neighborhood)
    {
        $this->neighborhood = $neighborhood;

        return $this;
    }

    /**
     * @param   string  $zipcode
     * @return  $this
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $this->onlyNumbers($zipcode);

        return $this;
    }

    /**
     * @param   string  $city
     * @return  $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @param   string  $state
     * @return  $this
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }
}