<?php

namespace App\Entity;

use App\Repository\PlanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanRepository::class)
 */
class Plan
{
    const TYPE = [
        0 => 'Diet',
        1 => 'Normal',
        2 => 'Gain',
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
    private $Name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="plan")
     */
    private $userPlan;

    public function __construct()
    {
        $this->userPlan = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

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

    public function getTypeType(): string
    {
        return self::TYPE[$this->type];
    }

    /**
     * @return Collection|User[]
     */
    public function getUserPlan(): Collection
    {
        return $this->userPlan;
    }

    public function addUserPlan(User $userPlan): self
    {
        if (!$this->userPlan->contains($userPlan)) {
            $this->userPlan[] = $userPlan;
            $userPlan->setPlan($this);
        }

        return $this;
    }

    public function removeUserPlan(User $userPlan): self
    {
        if ($this->userPlan->removeElement($userPlan)) {
            // set the owning side to null (unless already changed)
            if ($userPlan->getPlan() === $this) {
                $userPlan->setPlan(null);
            }
        }

        return $this;
    }
}
