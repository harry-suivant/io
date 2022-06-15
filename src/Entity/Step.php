<?php

namespace App\Entity;

use App\Repository\StepRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StepRepository::class)
 */
class Step
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\ManyToMany(targetEntity=Action::class, inversedBy="steps")
     */
    private Collection $actions;

    /**
     * @ORM\ManyToMany(targetEntity=Roadmap::class, mappedBy="steps")
     */
    private Collection $roadmaps;

    /**
     * @ORM\OneToMany(targetEntity=StepCheck::class, mappedBy="step", orphanRemoval=true)
     */
    private Collection $stepChecks;

    public function __construct()
    {
        $this->actions = new ArrayCollection();
        $this->roadmaps = new ArrayCollection();
        $this->stepChecks = new ArrayCollection();
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
     * @return Collection|Action[]
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(Action $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions[] = $action;
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        $this->actions->removeElement($action);

        return $this;
    }

    /**
     * @return Collection|Roadmap[]
     */
    public function getRoadmaps(): Collection
    {
        return $this->roadmaps;
    }

    public function addRoadmap(Roadmap $roadmap): self
    {
        if (!$this->roadmaps->contains($roadmap)) {
            $this->roadmaps[] = $roadmap;
            $roadmap->addStep($this);
        }

        return $this;
    }

    public function removeRoadmap(Roadmap $roadmap): self
    {
        if ($this->roadmaps->removeElement($roadmap)) {
            $roadmap->removeStep($this);
        }

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
            $stepCheck->setStep($this);
        }

        return $this;
    }

    public function removeStepCheck(StepCheck $stepCheck): self
    {
        if ($this->stepChecks->removeElement($stepCheck)) {
            // set the owning side to null (unless already changed)
            if ($stepCheck->getStep() === $this) {
                $stepCheck->setStep(null);
            }
        }

        return $this;
    }
}
