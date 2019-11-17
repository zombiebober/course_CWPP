<?php

declare(strict_types = 1);

namespace Service\Discount;

use Model;

class StandardDiscount implements IDiscount
{
    /**
     * @var float
     */
    private $discount = 0.01;

    /**
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }
}
