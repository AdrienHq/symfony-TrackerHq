<?php

namespace App\Entity;

use App\Repository\MealRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MealRepository::class)
 */
class Meal
{

    const TYPE = [
        0 => 'Collation',
        1 => 'Petit-déjeuner',
        2 => 'Déjeuner',
        3 => 'Diner'
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="mealRecipe")
     */
    private $userMeal;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredient::class, inversedBy="ingredientInMeal")
     */
    private $mealIngredient;

    /**
     * @ORM\ManyToMany(targetEntity=Recipe::class, inversedBy="recipeInMeal")
     */
    private $mealRecipes;

    public function __construct()
    {
        $this->mealIngredient = new ArrayCollection();
        $this->mealRecipes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUserMeal(): ?User
    {
        return $this->userMeal;
    }

    public function setUserMeal(?User $userMeal): self
    {
        $this->userMeal = $userMeal;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getMealIngredient(): Collection
    {
        return $this->mealIngredient;
    }

    public function addMealIngredient(Ingredient $mealIngredient): self
    {
        if (!$this->mealIngredient->contains($mealIngredient)) {
            $this->mealIngredient[] = $mealIngredient;
        }

        return $this;
    }

    public function removeMealIngredient(Ingredient $mealIngredient): self
    {
        $this->mealIngredient->removeElement($mealIngredient);

        return $this;
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getMealRecipes(): Collection
    {
        return $this->mealRecipes;
    }

    public function addMealRecipe(Recipe $mealRecipe): self
    {
        if (!$this->mealRecipes->contains($mealRecipe)) {
            $this->mealRecipes[] = $mealRecipe;
        }

        return $this;
    }

    public function removeMealRecipe(Recipe $mealRecipe): self
    {
        $this->mealRecipes->removeElement($mealRecipe);

        return $this;
    }

    public function getTypeType(): string
    {
        return self::TYPE[$this->type];
    }
}
