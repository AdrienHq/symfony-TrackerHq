<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use DateTime;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 * @Vich\Uploadable
 */
class Recipe
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Meal::class, mappedBy="mealRecipes")
     */
    private $recipeInMeal;

    /**
     * @ORM\OneToMany(targetEntity="IngredientQuantityInRecipe", mappedBy="recipe", fetch="EXTRA_LAZY", orphanRemoval=true, cascade={"persist"},)
     */
    private $ingredients;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @var File|null
     * @Assert\Image(
     *     mimeTypes={"image/png", "image/jpeg"}
     * )
     * @Vich\UploadableField(mapping="recipe_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->recipeInMeal = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return ArrayCollection|IngredientQuantityInRecipe[]
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    public function addIngredient(IngredientQuantityInRecipe $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
            $ingredient->setRecipe($this);
        }

        return $this;
    }

    public function removeIngredient(IngredientQuantityInRecipe $ingredient): self
    {
        $this->ingredients->removeElement($ingredient);

        return $this;
    }

    /*
    public function removeIngredient(IngredientQuantityInRecipe $ingredient): self
    {
        if (!$this->ingredient->contains($ingredient)) {
            return;
        }
        $this->ingredient->removeElement($genusSingredientcientist);
        $ingredient->setIngredient(null);
    }
    */
    
    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->name);

    }

    /**
     * @return Collection|Meal[]
     */
    public function getRecipeInMeal(): Collection
    {
        return $this->recipeInMeal;
    }

    public function addRecipeInMeal(Meal $recipeInMeal): self
    {
        if (!$this->recipeInMeal->contains($recipeInMeal)) {
            $this->recipeInMeal[] = $recipeInMeal;
            $recipeInMeal->addMealRecipe($this);
        }

        return $this;
    }

    public function removeRecipeInMeal(Meal $recipeInMeal): self
    {
        if ($this->recipeInMeal->removeElement($recipeInMeal)) {
            $recipeInMeal->removeMealRecipe($this);
        }

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param null|string $filename
     * @return Recipe
     */
    public function setFilename(?string $filename): Recipe
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param null|File $imageFile
     * @return Recipe
     */
    public function setImageFile(?File $imageFile): Recipe
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile){
            $this->updated_at = new \DateTime(('now'));
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
