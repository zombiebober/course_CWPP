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
     * @param ISort $sort
     *
     * @return Model\Entity\Product[]
     */
    public function getAll(ISort $sort=null): array
    {
        $productList = $this->getProductRepository()->fetchAll();
        if (!is_null($sort)) {
            $productList = $sort->sort($productList);
        }
        return $productList;
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
