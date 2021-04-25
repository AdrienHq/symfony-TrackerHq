<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, Serializable
{

    const GENDER = [
        0 => 'Male',
        1 => 'Female'
    ];

    const ACTIVITY = [
        0 => 'Sedentary',
        1 => 'Active',
        2 => 'Rather active',
        3 => 'Athletic'
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * @ORM\Column(type="integer")
     */
    private $height;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="integer")
     */
    private $gender;

    /**
     * @ORM\Column(type="integer")
     */
    private $activity;

    /**
     * @ORM\Column(type="integer")
     */
    private $brm;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\ManyToOne(targetEntity=Plan::class, inversedBy="userPlan")
     */
    private $plan;

    /**
     * @ORM\OneToMany(targetEntity=Meal::class, mappedBy="userMeal")
     */
    private $mealRecipe;

    public function __construct()
    {
        $this->mealRecipe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->firstname;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
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

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getGenderType(): string
    {
        return self::GENDER[$this->gender];
    }

    public function getActivity(): ?int
    {
        return $this->activity;
    }

    public function setActivity(int $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    public function getActivityType(): string
    {
        return self::ACTIVITY[$this->activity];
    }

    public function getBrm(): ?int
    {
        return $this->brm;
    }

    public function setBrm(int $brm): self
    {
        $this->brm = $brm;

        return $this;
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->email,
            $this->roles,
            $this->password,
            $this->firstname,
            $this->age,
            $this->name,
            $this->height,
            $this->weight,
            $this->activity,
            $this->gender,
        ]);
        
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->roles,
            $this->password,
            $this->firstname,
            $this->age,
            $this->name,
            $this->height,
            $this->weight,
            $this->activity,
            $this->gender,
            ) = unserialize($serialized, ['allowed_classed' => false]);  
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPlan(): ?Plan
    {
        return $this->plan;
    }

    public function setPlan(?Plan $plan): self
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * @return Collection|Meal[]
     */
    public function getMealRecipe(): Collection
    {
        return $this->mealRecipe;
    }

    public function addMealRecipe(Meal $mealRecipe): self
    {
        if (!$this->mealRecipe->contains($mealRecipe)) {
            $this->mealRecipe[] = $mealRecipe;
            $mealRecipe->setUserMeal($this);
        }

        return $this;
    }

    public function removeMealRecipe(Meal $mealRecipe): self
    {
        if ($this->mealRecipe->removeElement($mealRecipe)) {
            // set the owning side to null (unless already changed)
            if ($mealRecipe->getUserMeal() === $this) {
                $mealRecipe->setUserMeal(null);
            }
        }

        return $this;
    }
    
}
