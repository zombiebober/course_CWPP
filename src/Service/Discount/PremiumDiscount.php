<?php

declare(strict_types = 1);

namespace  Service\Discount;

use Model;

class PremiumDiscount implements IDiscount
{
    /**
     * @var float
     */
    private $discount = 0.08;

    public function getDiscount(): float
    {
        return $this->discount;
    }
}
