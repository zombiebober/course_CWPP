<?php


namespace Service\Product;

class SortName implements ISort
{

    /**
     * @param \Model\Entity\Product[] $product
     * @return \Model\Entity\Product[]
     */
    public function sort(array $product):array
    {
        usort($product, function (\Model\Entity\Product $a, \Model\Entity\Product $b) {
            return $a->getName() <=> $b->getName();
        });
        return $product;
    }
}
