<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(
    normalizationContext: ['groups' => ['category:read']],
    denormalizationContext: ['groups' => ['category:write']],
    paginationEnabled: true,
    paginationItemsPerPage: 30,
    paginationMaximumItemsPerPage: 100,
    paginationType: 'page'
)]
class Category
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    #[Groups(['category:read', 'product:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['category:read', 'category:write', 'product:read'])]
    private ?string $nameFr = null;

    #[ORM\Column]
    #[Groups(['category:read', 'category:write', 'product:read'])]
    private ?string $nameEn = null;

    #[ORM\Column]
    #[Groups(['category:read', 'category:write', 'product:read'])]
    private ?string $descriptionFr = null;

    #[ORM\Column]
    #[Groups(['category:read', 'category:write', 'product:read'])]
    private ?string $descriptionEn = null;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy:"categories")]
    /** @var Collection<int, Product> $products */
    private iterable $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameFr(): ?string
    {
        return $this->nameFr;
    }

    public function getNameEn(): ?string
    {
        return $this->nameEn;
    }

    public function getDescriptionFr(): ?string
    {
        return $this->descriptionFr;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    public function setNameFr(?string $nameFr): void
    {
        $this->nameFr = $nameFr;
    }

    public function setNameEn(?string $nameEn): void
    {
        $this->nameEn = $nameEn;
    }

    public function setDescriptionFr(?string $descriptionFr): void
    {
        $this->descriptionFr = $descriptionFr;
    }

    public function setDescriptionEn(?string $descriptionEn): void
    {
        $this->descriptionEn = $descriptionEn;
    }
}