<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\AuthController;

#[ORM\Entity]
#[ApiResource(
    operations: [
    ],
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    #[Groups(['user:read'])]
    private ?int $id = null;

    #[ORM\Column(unique: true)]
    #[Groups(['user:read'])]
    private ?string $username = null;

    #[ORM\Column]
    private ?string $password = null;


    #[ORM\Column(type: 'json')]
    private array $roles = ['ROLE_USER'];


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }


    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function getRoles(): array
    {
        $roles = $this->roles;
// guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }


    public function eraseCredentials(): void
    {
// If you store any temporary, sensitive data on the user, clear it here
        $this->password = null;
    }


    public function getUserIdentifier(): string
    {
        return (string)$this->username;
    }

}