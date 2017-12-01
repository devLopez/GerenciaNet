<?php

namespace Igrejanet\GerenciaNet\Contracts;

/**
 * CustomerContract
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   29/11/2017
 * @package Igrejanet\GerenciaNet\Contracts
 */
interface CustomerContract extends Arrayable
{
    public function setName($name);

    public function setCpf($cpf);

    public function setEmail($email);

    public function setPhoneNumber($phoneNumber);

    public function setBirth($birth);
}