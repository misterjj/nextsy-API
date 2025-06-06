<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
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
    normalizationContext: ['groups' => ['product:read']],
    denormalizationContext: ['groups' => ['product:write']],
    paginationEnabled: true,
    paginationItemsPerPage: 30,
    paginationMaximumItemsPerPage: 100,
    paginationType: 'page'
)]
#[ApiFilter(OrderFilter::class, properties: ['id', 'price', 'stock', 'nameFr', 'nameEn'])]
#[ApiFilter(RangeFilter::class, properties: ['price', 'stock'])]
#[ApiFilter(SearchFilter::class, properties: [
    'id' => 'exact',
    'nameFr' => 'ipartial',
    'nameEn' => 'ipartial',
    'categories.id' => 'exact',
])]
class Product
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    #[Groups(['product:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Assert\NotBlank]
    #[Assert\Positive]
    #[Groups(['product:read', 'product:write'])]
    private float $price;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    #[Groups(['product:read', 'product:write'])]
    private int $stock = 0;

    #[ORM\Column(nullable: true)]
    #[Groups(['product:read', 'product:write'])]
    private ?string $image = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?string $nameFr = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?string $nameEn = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?string $descriptionFr = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?string $descriptionEn = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy:"products")]
    #[Groups(['product:read', 'product:write'])]
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