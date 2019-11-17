<?php

declare(strict_types = 1);

namespace Service\Discount;

use Model;

class AdvancedDiscount implements IDiscount
{
    /**
     * @var float
     */
    private $discount = 0.03;

    public function getDiscount(): float
    {
        return $this->discount;
    }
}
