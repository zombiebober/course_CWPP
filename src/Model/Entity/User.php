<?php

declare(strict_types = 1);

namespace Model\Entity;

use Service\Discount\IDiscount;

class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $passwordHash;

    /**
     * @var Role
     */
    private $role;

    /**
     * @var IDiscount
     */
    private $discount;

    /**
     * @param int $id
     * @param string $name
     * @param string $login
     * @param string $password
     * @param Role $role
     */
    public function __construct(int $id, string $name, string $login, string $password, Role $role, IDiscount $discount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->login = $login;
        $this->passwordHash = $password;
        $this->role = $role;
        $this->discount = $discount;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @return IDiscount
     */
    public function getDiscount(): IDiscount
    {
        return $this->discount;
    }
}
