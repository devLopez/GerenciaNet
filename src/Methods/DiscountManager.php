<?php

namespace Igrejanet\GerenciaNet\Methods;

use Igrejanet\GerenciaNet\Serializable;

/**
 * DiscountManager
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   29/11/2017
 * @package Igrejanet\GerenciaNet\Methods
 */
class DiscountManager
{
    use Serializable;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $value;

    /**
     * @param   int  $value
     * @param   string  $type
     */
    public function __construct(int $value, $type = 'percentage')
    {
        $this->value    = $value;
        $this->type     = $type;
    }
}