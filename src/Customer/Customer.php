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
     * @param   string  $name
     * @param   string  $cpf
     * @param   string  $email
     * @param   string  $phone_number
     * @param   string|null  $birth
     * @param   bool  $isJuridical
     */
    public function __construct($name, $cpf, $email, $phone_number, $birth = null, bool $isJuridical = false)
    {
        if( $isJuridical ) {
            $this->setJuridicalPerson($name, $cpf);
        } else {
            $this->setName($name);
            $this->setCpf($cpf);
        }

        $this->setEmail($email);
        $this->setPhoneNumber($phone_number);
        $this->setBirth($birth);
    }

    public function setJuridicalPerson($companyName, $cnpj)
    {
        $document = $this->onlyNumbers($cnpj, true);

        $this->juridical_person = [
            'corporate_name'    => $companyName,
            'cnpj'              => $document
        ];

        unset($this->name, $this->cpf);

        return $this;
    }

    /**
     * @param   string  $name
     * @return  $this
     */
    public function setName($name)
    {
        $this->name = $name;

        unset($this->juridical_person);

        return $this;
    }

    /**
     * @param   string  $cpf
     * @return  $this
     */
    public function setCpf($cpf)
    {
        $this->cpf = $this->onlyNumbers($cpf, true);

        unset($this->juridical_person);

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
    public function setBirth($birth = null)
    {
        if( $birth ) {
            $this->birth = $birth;
        } else {
            unset($this->birth);
        }

        return $this;
    }
}