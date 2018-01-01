<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 * @ORM\Table("sessions")
 */
class Session
{
    /**
     * @var int
     *
     * @ORM\Column("sess_id", type="integer", options={"unsigned": true})
     * @ORM\Id
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id", nullable=false)
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private $startTime;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=15)
     */
    private $remoteIp;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Session
    {
        $this->id = $id;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): Session
    {
        $this->user = $user;

        return $this;
    }

    public function getStartTime(): int
    {
        return $this->startTime;
    }

    public function setStartTime(int $startTime): Session
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getRemoteIp(): string
    {
        return $this->remoteIp;
    }

    public function setRemoteIp(string $remoteIp): Session
    {
        $this->remoteIp = $remoteIp;

        return $this;
    }
}
