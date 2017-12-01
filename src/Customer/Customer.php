<?php

namespace Igrejanet\GerenciaNet\Customer;

use Igrejanet\GerenciaNet\Contracts\CustomerContract;
use Igrejanet\GerenciaNet\Sanitizable;
use Igrejanet\GerenciaNet\Serializable;

/**
 * Customer
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   29/11/2017
 * @package Igrejanet\GerenciaNet\Customer
 */
class Customer implements CustomerContract
{
    use Serializable, Sanitizable;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $cpf;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $phone_number;

    /**
     * @var string
     */
    protected $birth;

    /**
     * @param   $name
     * @param   $cpf
     * @param   $email
     * @param   $phone_number
     * @param   $birth
     */
    public function __construct($name, $cpf, $email, $phone_number, $birth)
    {
        $this->name         = $name;
        $this->cpf          = $this->onlyNumbers($cpf, true);
        $this->email        = $email;
        $this->phone_number = $this->onlyNumbers($phone_number, true);
        $this->birth        = $birth;
    }

    /**
     * @param   string  $name
     * @return  $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param   string  $cpf
     * @return  $this
     */
    public function setCpf($cpf)
    {
        $this->cpf = $this->onlyNumbers($cpf, true);

        return $this;
    }

    /**
     * @param   string  $email
     * @return  $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param   string  $phone_number
     * @return  $this
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $this->onlyNumbers($phone_number, true);

        return $this;
    }

    /**
     * @param   string  $birth
     * @return  $this
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;

        return $this;
    }
}