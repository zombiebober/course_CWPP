<?php
declare(strict_types=1);

namespace Service\Discount;

use Model\Entity\Product;

class DiscountCalculate
{
    /**
     * @var IDiscount
     */
    private $discount;

    /**
     * DiscountCalculate constructor.
     * @param IDiscount $discount
     */
    public function __construct(IDiscount $discount)
    {
        $this->discount = $discount;
    }

    /**
     * @param Product $product
     * @return Product
     */
    public function calculate(Product $product): Product
    {
        return new Product(
            $product->getId(),
            $product->getName(),
            $product->getPrice() - $product->getPrice() * $this->discount->getDiscount(),
            $product->getDescription()
        );
    }

    /**
     * @param Product[] $productList
     * @return Product[]
     */
    public function calculateAll(array $productList): array
    {
        $result=[];
        foreach ($productList as $key => $product) {
            $result[]= $this->calculate($product);
        }
        return $result;
    }
}
