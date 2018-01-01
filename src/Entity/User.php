<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table("users")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column("user_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column("user_password", type="string", length=32)
     */
    private $password;

    /**
     * @var int
     *
     * @ORM\Column("user_level", type="integer")
     */
    private $level;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): User
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): User
    {
        $this->level = $level;

        return $this;
    }
}
