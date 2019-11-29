<?php


namespace Service\Product;

class SortPrice implements ISort
{
    /**
     * @param \Model\Entity\Product[] $product
     * @return \Model\Entity\Product[]
     */
    public function sort(array $product): array
    {
        usort($product, function (\Model\Entity\Product $a, \Model\Entity\Product $b) {
            return $a->getPrice() > $b->getPrice();
        });

        return $product;
    }
}
