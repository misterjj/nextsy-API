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
class Product
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private float $price;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    private int $stock = 0;

    #[ORM\Column(nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?string $nameFr = null;

    #[ORM\Column]
    private ?string $nameEn = null;

    #[ORM\Column]
    private ?string $descriptionFr = null;

    #[ORM\Column]
    private ?string $descriptionEn = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy:"products")]
    #[Assert\NotBlank]
    /** @var Collection<int, Category> $categories */
    private iterable $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getImage(): ?string
    {
        return $this->image;
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

    public function getCategories(): ArrayCollection|Collection|iterable
    {
        return $this->categories;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
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

    public function setCategories(iterable $categories): void
    {
        $this->categories = $categories;
    }
}