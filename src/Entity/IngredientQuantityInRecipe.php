<?php

namespace App\Entity;

use App\Repository\IngredientQuantityInRecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientQuantityInRecipeRepository::class)
 */
class IngredientQuantityInRecipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $grams;

    /**
     * @ORM\ManyToOne(targetEntity="Recipe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

    /**
     * @ORM\ManyToOne(targetEntity="Ingredient")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrams(): ?int
    {
        return $this->grams;
    }

    public function setGrams(?int $grams): void
    {
        $this->grams = $grams;
    }

    /**
     * @return mixed
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * @param mixed $recipe
     */
    public function setRecipe($recipe): void
    {
        $this->recipe = $recipe;
    }

    /**
     * @return mixed
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }

    /**
     * @param mixed $ingredient
     */
    public function setIngredient($ingredient): void
    {
        $this->ingredient = $ingredient;
    }
}
