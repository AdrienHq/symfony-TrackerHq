<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 * @UniqueEntity("name")
 */
class Ingredient
{
    const TYPE = [
        0 => 'Unknown',
        1 => 'Meat',
        2 => 'Vegetable',
        3 => 'Fish',
        4 => 'Dairy',
        5 => 'Grains',
        6 => 'Fruit'
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $type = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2))
     */
    private $carbohydrate;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2))
     */
    private $fat;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2))
     */
    private $protein;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2))
     */
    private $sugar;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2))
     */
    private $energy;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $created_by;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->name);

    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTypeType(): string
    {
        return self::TYPE[$this->type];
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCarbohydrate(): string
    {
        return $this->carbohydrate;
    }

    public function setCarbohydrate(string $carbohydrate): self
    {
        $this->carbohydrate = $carbohydrate;

        return $this;
    }

    public function getFat(): string
    {
        return $this->fat;
    }

    public function setFat(string $fat): self
    {
        $this->fat = $fat;

        return $this;
    }

    public function getProtein(): string
    {
        return $this->protein;
    }

    public function setProtein(string $protein): self
    {
        $this->protein = $protein;

        return $this;
    }

    public function getSugar(): string
    {
        return $this->sugar;
    }

    public function setSugar(string $sugar): self
    {
        $this->sugar = $sugar;

        return $this;
    }

    public function getEnergy(): string
    {
        return $this->energy;
    }

    public function setEnergy(string $energy): self
    {
        $this->energy = $energy;

        return $this;
    }

    public function getCreatedBy(): ?string
    {
        return $this->created_by;
    }

    public function setCreatedBy(?string $created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }
}
