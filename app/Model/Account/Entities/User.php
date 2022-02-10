<?php

namespace App\Model\Account\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Nette\Security\IIdentity;

/**
 * @ORM\Entity(repositoryClass="App\Model\Account\Repositories\UserRepository")
 * @ORM\Table(name="sportisimo_account_user")
 */
class User implements IIdentity
{
    public const ROLE_SUPERADMIN = 'superadmin';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_MEMBER = 'member';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    public int $id;

    /**
     * @ORM\Column(type="string", unique=TRUE)
     */
    private string $email;

    /**
     * @ORM\Column(type="string")
     */
    private string $username;

    /**
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\Column(type="string")
     */
    private string $role;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $active;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $createdAt;

    public function __construct(string $email, string $username, string $password, string $role = self::ROLE_MEMBER, bool $active = true)
    {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->active = $active;
        $this->createdAt = new DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return [$this->role];
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function isActive(): bool
    {
        return $this->active;
    }
}
