<?php

namespace App\Entity;

use App\Repository\ActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActionRepository::class)
 */
class Action
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
     * @ORM\Column(type="text")
     */
    private string $text;

    /**
     * @ORM\ManyToMany(targetEntity=Ressource::class, inversedBy="actions")
     */
    private Collection $ressource;

    /**
     * @ORM\ManyToMany(targetEntity=Step::class, mappedBy="actions")
     */
    private Collection $steps;

    /**
     * @ORM\OneToMany(targetEntity=ActionCheck::class, mappedBy="action")
     */
    private Collection $actionChecks;

    public function __construct()
    {
        $this->ressource = new ArrayCollection();
        $this->steps = new ArrayCollection();
        $this->actionChecks = new ArrayCollection();
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return Collection|Ressource[]
     */
    public function getRessource(): Collection
    {
        return $this->ressource;
    }

    public function addRessource(Ressource $ressource): self
    {
        if (!$this->ressource->contains($ressource)) {
            $this->ressource[] = $ressource;
        }

        return $this;
    }

    public function removeRessource(Ressource $ressource): self
    {
        $this->ressource->removeElement($ressource);

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
            $step->addAction($this);
        }

        return $this;
    }

    public function removeStep(Step $step): self
    {
        if ($this->steps->removeElement($step)) {
            $step->removeAction($this);
        }

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
            $actionCheck->setAction($this);
        }

        return $this;
    }

    public function removeActionCheck(ActionCheck $actionCheck): self
    {
        if ($this->actionChecks->removeElement($actionCheck)) {
            // set the owning side to null (unless already changed)
            if ($actionCheck->getAction() === $this) {
                $actionCheck->setAction(null);
            }
        }

        return $this;
    }
}
