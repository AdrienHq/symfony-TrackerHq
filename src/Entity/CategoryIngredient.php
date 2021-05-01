<?php

namespace App\Entity;

use App\Repository\CategoryIngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryIngredientRepository::class)
 */
class CategoryIngredient
{
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
     * @ORM\ManyToMany(targetEntity=Ingredient::class, mappedBy="categoryIngredient")
     */
    private $categoryIngredients;

    public function __construct()
    {
        $this->categoryIngredients = new ArrayCollection();
    }

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

    /**
     * @return Collection|Ingredient[]
     */
    public function getCategoryIngredients(): Collection
    {
        return $this->categoryIngredients;
    }

    public function addCategoryIngredient(Ingredient $categoryIngredient): self
    {
        if (!$this->categoryIngredients->contains($categoryIngredient)) {
            $this->categoryIngredients[] = $categoryIngredient;
            $categoryIngredient->addCategoryIngredient($this);
        }

        return $this;
    }

    public function removeCategoryIngredient(Ingredient $categoryIngredient): self
    {
        if ($this->categoryIngredients->removeElement($categoryIngredient)) {
            $categoryIngredient->removeCategoryIngredient($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
