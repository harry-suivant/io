<?php

namespace App\Entity;

use App\Repository\RoadmapCheckRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoadmapCheckRepository::class)
 */
class RoadmapCheck
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="roadmapChecks")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $user;

    /**
     * @ORM\ManyToOne(targetEntity=Roadmap::class, inversedBy="roadmapChecks")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Type("App\Entity\Roadmap")
     */
    private ?Roadmap $roadmap;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isComplete;

    /**
     * @ORM\OneToMany(targetEntity=StepCheck::class, mappedBy="roadmapCheck", orphanRemoval=true)
     */
    private Collection $stepChecks;

    public function __construct()
    {
        $this->stepChecks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRoadmap(): ?Roadmap
    {
        return $this->roadmap;
    }

    public function setRoadmap(?Roadmap $roadmap): self
    {
        $this->roadmap = $roadmap;

        return $this;
    }

    public function getIsComplete(): ?bool
    {
        return $this->isComplete;
    }

    public function setIsComplete(bool $isComplete): self
    {
        $this->isComplete = $isComplete;

        return $this;
    }

    /**
     * @return Collection|StepCheck[]
     */
    public function getStepChecks(): Collection
    {
        return $this->stepChecks;
    }

    public function addStepCheck(StepCheck $stepCheck): self
    {
        if (!$this->stepChecks->contains($stepCheck)) {
            $this->stepChecks[] = $stepCheck;
            $stepCheck->setRoadmapCheck($this);
        }

        return $this;
    }

    public function removeStepCheck(StepCheck $stepCheck): self
    {
        if ($this->stepChecks->removeElement($stepCheck)) {
            // set the owning side to null (unless already changed)
            if ($stepCheck->getRoadmapCheck() === $this) {
                $stepCheck->setRoadmapCheck(null);
            }
        }

        return $this;
    }
}
