<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 * @UniqueEntity("name")
 * @Vich\Uploadable
 */
class Ingredient
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    private $quantity = false;

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

    /**
     * @ORM\ManyToMany(targetEntity=Meal::class, mappedBy="mealIngredient")
     */
    private $ingredientInMeal;

    /**
     * @ORM\OneToMany(targetEntity=IngredientQuantityInRecipe::class, mappedBy="ingredient", fetch="EXTRA_LAZY")
     */
    private $recipes;

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
     * @Vich\UploadableField(mapping="ingredient_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\ManyToMany(targetEntity=CategoryIngredient::class, inversedBy="categoryIngredients")
     */
    private $categoryIngredient;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
        $this->ingredientInMeal = new ArrayCollection();
        $this->categoryIngredient = new ArrayCollection();
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

    public function getQuantity(): ?bool
    {
        return $this->quantity;
    }

    public function setQuantity(?bool $quantity): self
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

    /**
     * @return ArrayCollection|IngredientQuantityInRecipe[]
     */
    public function getRecipes()
    {
        return $this->recipes;
    }

    public function addRecipe(IngredientQuantityInRecipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->addIngredient($this);
        }

        return $this;
    }

    public function removeRecipe(IngredientQuantityInRecipe $recipe): self
    {
        if ($this->recipes->removeElement($recipe)) {
            $recipe->removeIngredient($this);
        }

        return $this;
    }

    /**
     * @return Collection|Meal[]
     */
    public function getIngredientInMeal(): Collection
    {
        return $this->ingredientInMeal;
    }

    public function addIngredientInMeal(Meal $ingredientInMeal): self
    {
        if (!$this->ingredientInMeal->contains($ingredientInMeal)) {
            $this->ingredientInMeal[] = $ingredientInMeal;
            $ingredientInMeal->addMealIngredient($this);
        }

        return $this;
    }

    public function removeIngredientInMeal(Meal $ingredientInMeal): self
    {
        if ($this->ingredientInMeal->removeElement($ingredientInMeal)) {
            $ingredientInMeal->removeMealIngredient($this);
        }

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param null|string $filename
     * @return Ingredient
     */
    public function setFilename(?string $filename): Ingredient
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
     * @return Ingredient
     */
    public function setImageFile(?File $imageFile): Ingredient
    {
        $this->imageFile = $imageFile;
        return $this;
    }

    /**
     * @return Collection|CategoryIngredient[]
     */
    public function getCategoryIngredient(): Collection
    {
        return $this->categoryIngredient;
    }

    public function addCategoryIngredient(CategoryIngredient $categoryIngredient): self
    {
        if (!$this->categoryIngredient->contains($categoryIngredient)) {
            $this->categoryIngredient[] = $categoryIngredient;
        }

        return $this;
    }

    public function removeCategoryIngredient(CategoryIngredient $categoryIngredient): self
    {
        $this->categoryIngredient->removeElement($categoryIngredient);

        return $this;
    }
}
