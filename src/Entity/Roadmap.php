<?php

namespace App\Entity;

use App\Repository\RoadmapRepository;
use App\Service\RoadmapManagement;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoadmapRepository::class)
 */
class Roadmap
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
     * @ORM\ManyToMany(targetEntity=Step::class, inversedBy="roadmaps")
     */
    private Collection $steps;

    /**
     * @ORM\OneToMany(targetEntity=RoadmapCheck::class, mappedBy="roadmap", orphanRemoval=true)
     */
    private Collection $roadmapChecks;

    public function __construct()
    {
        $this->steps = new ArrayCollection();
        $this->roadmapChecks = new ArrayCollection();
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
     * @return Collection|Step[]
     */
    public function getSteps(): Collection
    {
        return $this->steps;
    }

    public function addStep(Step $step): self
    {
        if (!$this->steps->contains($step)) {
            $this->steps[] = $step;
        }

        return $this;
    }

    public function removeStep(Step $step): self
    {
        $this->steps->removeElement($step);

        return $this;
    }

    /**
     * @return Collection|RoadmapCheck[]
     */
    public function getRoadmapChecks(): Collection
    {
        return $this->roadmapChecks;
    }

    public function addRoadmapCheck(RoadmapCheck $roadmapCheck): self
    {
        if (!$this->roadmapChecks->contains($roadmapCheck)) {
            $this->roadmapChecks[] = $roadmapCheck;
            $roadmapCheck->setRoadmap($this);
        }

        return $this;
    }

    public function removeRoadmapCheck(RoadmapCheck $roadmapCheck): self
    {
        if ($this->roadmapChecks->removeElement($roadmapCheck)) {
            // set the owning side to null (unless already changed)
            if ($roadmapCheck->getRoadmap() === $this) {
                $roadmapCheck->setRoadmap(null);
            }
        }

        return $this;
    }
}
