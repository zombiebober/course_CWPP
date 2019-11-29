<?php
declare(strict_types=1);

namespace Service\Product;

interface ISort
{
    /**
     * @param \Model\Entity\Product[] $product
     * @return \Model\Entity\Product[]
     */
    public function sort(array $product): array ;
}
