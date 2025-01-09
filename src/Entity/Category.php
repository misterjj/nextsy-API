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
#[ApiResource]
class Category
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $nameFr = null;

    #[ORM\Column]
    private ?string $nameEn = null;

    #[ORM\Column]
    private ?string $descriptionFr = null;

    #[ORM\Column]
    private ?string $descriptionEn = null;

    #[ORM\JoinTable(name: 'products_categories')]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'product_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'categories')]
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