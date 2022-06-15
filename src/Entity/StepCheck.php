<?php

namespace App\Entity;

use App\Repository\StepCheckRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StepCheckRepository::class)
 */
class StepCheck
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=RoadmapCheck::class, inversedBy="stepChecks")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?RoadmapCheck $roadmapCheck;

    /**
     * @ORM\ManyToOne(targetEntity=Step::class, inversedBy="stepChecks")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Step $step;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isComplete;

    /**
     * @ORM\OneToMany(targetEntity=ActionCheck::class, mappedBy="stepCheck", orphanRemoval=true)
     */
    private Collection $actionChecks;

    public function __construct()
    {
        $this->actionChecks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoadmapCheck(): ?RoadmapCheck
    {
        return $this->roadmapCheck;
    }

    public function setRoadmapCheck(?RoadmapCheck $roadmapCheck): self
    {
        $this->roadmapCheck = $roadmapCheck;

        return $this;
    }

    public function getStep(): ?Step
    {
        return $this->step;
    }

    public function setStep(?Step $step): self
    {
        $this->step = $step;

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
     * @return Collection|ActionCheck[]
     */
    public function getActionChecks(): Collection
    {
        return $this->actionChecks;
    }

    public function addActionCheck(ActionCheck $actionCheck): self
    {
        if (!$this->actionChecks->contains($actionCheck)) {
            $this->actionChecks[] = $actionCheck;
            $actionCheck->setStepCheck($this);
        }

        return $this;
    }

    public function removeActionCheck(ActionCheck $actionCheck): self
    {
        if ($this->actionChecks->removeElement($actionCheck)) {
            // set the owning side to null (unless already changed)
            if ($actionCheck->getStepCheck() === $this) {
                $actionCheck->setStepCheck(null);
            }
        }

        return $this;
    }
}
