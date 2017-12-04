<?php

namespace Igrejanet\GerenciaNet;

use Exception;
use Gerencianet\Gerencianet;

/**
 * Notifications
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   04/12/2017
 * @package Igrejanet\GerenciaNet
 */
class Notifications
{
    /**
     * @var Gerencianet
     */
    protected $gerencianet;

    /**
     * @param   Gerencianet  $gerencianet
     */
    public function __construct(Gerencianet $gerencianet)
    {
        $this->gerencianet = $gerencianet;
    }

    /**
     * @param   string  $notificationToken
     * @return  array
     * @throws  Exception
     */
    public function receiveNotification(string $notificationToken) : array
    {
        $chargeNotification = $this->gerencianet->getNotification([
            'token' => $notificationToken
        ], []);

        if($chargeNotification['code'] !== 200) {
            throw new Exception('O código passado pelo GerenciaNet é inválido');
        }

        return $chargeNotification['data'];
    }
}