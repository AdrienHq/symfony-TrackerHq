<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
{
    const TYPE = [
        0 => 'unknown',
        1 => 'meat',
        2 => 'vegetable',
        3 => 'fish',
        4 => 'dairy',
        5 => 'grains',
        6 => 'fruit'
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
     * @ORM\Column(type="decimal", precision=5, scale=2))
     */
    private $carbohydrate;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2))
     */
    private $fat;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2))
     */
    private $protein;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2))
     */
    private $sugar;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2))
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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCarbohydrate(): ?int
    {
        return $this->carbohydrate;
    }

    public function setCarbohydrate(int $carbohydrate): self
    {
        $this->carbohydrate = $carbohydrate;

        return $this;
    }

    public function getFat(): ?int
    {
        return $this->fat;
    }

    public function setFat(int $fat): self
    {
        $this->fat = $fat;

        return $this;
    }

    public function getProtein(): ?int
    {
        return $this->protein;
    }

    public function setProtein(int $protein): self
    {
        $this->protein = $protein;

        return $this;
    }

    public function getSugar(): ?int
    {
        return $this->sugar;
    }

    public function setSugar(int $sugar): self
    {
        $this->sugar = $sugar;

        return $this;
    }

    public function getEnergy(): ?int
    {
        return $this->energy;
    }

    public function setEnergy(int $energy): self
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
