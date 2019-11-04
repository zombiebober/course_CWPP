<?php

declare(strict_types = 1);

namespace Service\Product;

use Model;
use Service\Discount\IDiscount;

class Product
{
    /**
     * Получаем информацию по конкретному продукту
     *
     * @param int $id
     * @return Model\Entity\Product|null
     */
    public function getInfo(int $id): ?Model\Entity\Product
    {
        $product = $this->getProductRepository()->search([$id]);
        return count($product) ? $product[0] : null;
    }

    /**
     * Получаем все продукты
     *
     * @param string $sortType
     *
     * @return Model\Entity\Product[]
     */
    public function getAll(string $sortType): array
    {
        $productList = $this->getProductRepository()->fetchAll();

        // Применить паттерн Стратегия
        // $sortType === 'price'; // Сортировка по цене
        // $sortType === 'name'; // Сортировка по имени
        return $productList;
    }

    public function calculateAll(string $sortType, IDiscount $discount): array
    {
        $productList = $this->getAll($sortType);
        $result=[];
        foreach($productList as $key => $product){
            $result[]= $this->calculate($discount, $product);
        }
        return $result;
    }

    public function calculate(IDiscount $discount, Model\Entity\Product $product):  Model\Entity\Product
    {
        return new Model\Entity\Product($product->getId(),$product->getName(),
            $product->getPrice() - $product->getPrice() * $discount->getDiscount(),$product->getDescription());
    }

    /**
     * Фабричный метод для репозитория Product
     *
     * @return Model\Repository\Product
     */
    protected function getProductRepository(): Model\Repository\Product
    {
        return new Model\Repository\Product();
    }
}
