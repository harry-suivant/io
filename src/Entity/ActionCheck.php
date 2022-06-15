<?php

namespace App\Entity;

use App\Repository\ActionCheckRepository;
use Collator;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActionCheckRepository::class)
 */
class ActionCheck
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=StepCheck::class, inversedBy="actionChecks")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?StepCheck $stepCheck;

    /**
     * @ORM\ManyToOne(targetEntity=Action::class, inversedBy="actionChecks")
     */
    private ?Action $action;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isComplete;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStepCheck(): ?StepCheck
    {
        return $this->stepCheck;
    }

    public function setStepCheck(?StepCheck $stepCheck): self
    {
        $this->stepCheck = $stepCheck;

        return $this;
    }

    public function getAction(): ?Action
    {
        return $this->action;
    }

    public function setAction(?Action $action): self
    {
        $this->action = $action;

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
}
