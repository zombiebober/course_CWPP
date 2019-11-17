<?php

declare(strict_types = 1);

namespace Model\Repository;

use Model\Entity;
use Service\Discount\AdvancedDiscount;
use Service\Discount\PremiumDiscount;
use Service\Discount\StandardDiscount;

class User
{
    private static $premiumDiscount = "PremiumDiscount";
    private static $advancedDiscount = "AdvancedDiscount";
    private static $standardDiscount = "StandardDiscount";
    /**
     * Получаем пользователя по идентификатору
     *
     * @param int $id
     * @return Entity\User|null
     */
    public function getById(int $id): ?Entity\User
    {
        foreach ($this->getDataFromSource(['id' => $id]) as $user) {
            return $this->createUser($user);
        }

        return null;
    }

    /**
     * Получаем пользователя по логину
     *
     * @param string $login
     * @return Entity\User
     */
    public function getByLogin(string $login): ?Entity\User
    {
        foreach ($this->getDataFromSource(['login' => $login]) as $user) {
            if ($user['login'] === $login) {
                return $this->createUser($user);
            }
        }

        return null;
    }

    /**
     * Получаем все продукты
     *
     * @return array
     */
    public function fetchAll(): array
    {
        $userList = [];
        foreach ($this->getDataFromSource() as $item) {
            $userList[]=$this->createUser($item);
        }

        return $userList;
    }

    /**
     * Фабрика по созданию сущности пользователя
     *
     * @param array $user
     * @return Entity\User
     */
    private function createUser(array $user): Entity\User
    {
        $role = $user['role'];

        if ($user['discount'] == self::$advancedDiscount) {
            $discount = new AdvancedDiscount();
        } elseif ($user['discount'] == self::$standardDiscount) {
            $discount = new StandardDiscount();
        } elseif ($user['discount'] == self::$premiumDiscount) {
            $discount = new PremiumDiscount();
        }
        return new Entity\User(
            $user['id'],
            $user['name'],
            $user['login'],
            $user['password'],
            new Entity\Role($role['id'], $role['title'], $role['role']),
            $discount
        );
    }

    /**
     * Получаем пользователей из источника данных
     *
     * @param array $search
     *
     * @return array
     */
    private function getDataFromSource(array $search = [])
    {
        $admin = ['id' => 1, 'title' => 'Super Admin', 'role' => 'admin'];
        $user = ['id' => 1, 'title' => 'Main user', 'role' => 'user'];
        $test = ['id' => 1, 'title' => 'For test needed', 'role' => 'test'];

        $dataSource = [
            [
                'id' => 1,
                'name' => 'Super Admin',
                'login' => 'root',
                'password' => '$2y$10$GnZbayyccTIDIT5nceez7u7z1u6K.znlEf9Jb19CLGK0NGbaorw8W', // 1234
                'role' => $admin,
                'discount' => self::$premiumDiscount
            ],
            [
                'id' => 2,
                'name' => 'Doe John',
                'login' => 'doejohn',
                'password' => '$2y$10$j4DX.lEvkVLVt6PoAXr6VuomG3YfnssrW0GA8808Dy5ydwND/n8DW', // qwerty
                'role' => $user,
                'discount' => self::$standardDiscount
            ],
            [
                'id' => 3,
                'name' => 'Ivanov Ivan Ivanovich',
                'login' => 'i**3',
                'password' => '$2y$10$TcQdU.qWG0s7XGeIqnhquOH/v3r2KKbes8bLIL6NFWpqfFn.cwWha', // PaSsWoRd
                'role' => $user,
                'discount' => self::$standardDiscount
            ],
            [
                'id' => 4,
                'name' => 'Test Testov Testovich',
                'login' => 'testok',
                'password' => '$2y$10$vQvuFc6vQQyon0IawbmUN.3cPBXmuaZYsVww5csFRLvLCLPTiYwMa', // testss
                'role' => $test,
                'discount' => self::$advancedDiscount
            ],
            [
                'id' => 6,
                'name' => "student",
                'login' => 'student',
                'password' => '$2y$10$XTMIPBr2DL9gWctkIi7yfu2oEWMRxdwJQvNuG87516xtW3Z3uLsq6', //123
                'role' => $user,
                'discount' => self::$premiumDiscount
            ]
        ];

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (array $dataSource) use ($search): bool {
            return (bool) array_intersect($dataSource, $search);
        };

        return array_filter($dataSource, $productFilter);
    }
}
