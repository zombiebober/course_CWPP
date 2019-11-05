<?php

declare(strict_types = 1);

namespace Service\User;

use Model;

class User
{
    /**
     * Получаем все продукты
     *
     * @return Model\Entity\User[]
     */
    public function getAll(): array
    {
        $userList = $this->getUserRepository()->fetchAll();

        usort($userList, function (Model\Entity\User $a, Model\Entity\User $b) {
            return $a->getDiscount()->getDiscount() <=> $b->getDiscount()->getDiscount();
        });

        return $userList;
    }

    /**
     * Фабричный метод для репозитория User
     *
     * @return Model\Repository\User
     */
    protected function getUserRepository(): Model\Repository\User
    {
        return new Model\Repository\User();
    }
}
