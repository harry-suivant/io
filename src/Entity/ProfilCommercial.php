<?php

namespace App\Entity;

use App\Repository\ProfilComRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProfilComRepository::class)
 */
class ProfilCommercial
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\OneToOne(targetEntity=Profil::class, inversedBy="profilCommercial", cascade={"persist", "remove"})
     */
    private Profil $profil;

    /**
     * @ORM\Column(type="integer")
     */
    private int $crmUsed;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $crmName;

    /**
     * @ORM\Column(type="integer")
     */
    private int $timeOfProspec;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex("/^\+?\d+$/", message="Veuillez entrer un temps en heures")
     */
    private ?string $precisTimeOfProspec;

    /**
     * @ORM\Column(type="array")
     */
    private array $typeOfProspec = [];

    /**
     * @ORM\Column(type="integer")
     */
    private int $prospecMoreClient;

    /**
     * @ORM\Column(type="integer")
     */
    private int $numberClosPerMonth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex("/^\+?\d+$/", message="Veuillez entrer un nombre")
     */
    private ?string $precisClosPerMonth;

    /**
     * @ORM\Column(type="integer")
     */
    private int $budOfProspPerMonth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex("/^\+?\d+$/", message="Veuillez entrer un nombre")
     */
    private ?string $prcisBudProsMonth;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $analyseProspec;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $satisfiedOfRoi;

    /**
     * @ORM\Column(type="json")
     */
    private array $priorityCommercial = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $prcisPrioCommercial;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getCrmUsed(): ?int
    {
        return $this->crmUsed;
    }

    public function setCrmUsed(int $crmUsed): self
    {
        $this->crmUsed = $crmUsed;

        return $this;
    }

    public function getCrmName(): ?string
    {
        return $this->crmName;
    }

    public function setCrmName(?string $crmName): self
    {
        $this->crmName = $crmName;

        return $this;
    }

    public function getTimeOfProspec(): ?int
    {
        return $this->timeOfProspec;
    }

    public function setTimeOfProspec(int $timeOfProspec): self
    {
        $this->timeOfProspec = $timeOfProspec;

        return $this;
    }

    public function getPrecisTimeOfProspec(): ?string
    {
        return $this->precisTimeOfProspec;
    }

    public function setPrecisTimeOfProspec(?string $precisTimeOfProspec): self
    {
        $this->precisTimeOfProspec = $precisTimeOfProspec;

        return $this;
    }

    public function getTypeOfProspec(): ?array
    {
        return $this->typeOfProspec;
    }

    public function setTypeOfProspec(array $typeOfProspec): self
    {
        $this->typeOfProspec = $typeOfProspec;

        return $this;
    }

    public function getProspecMoreClient(): ?int
    {
        return $this->prospecMoreClient;
    }

    public function setProspecMoreClient(int $prospecMoreClient): self
    {
        $this->prospecMoreClient = $prospecMoreClient;

        return $this;
    }

    public function getNumberClosPerMonth(): ?int
    {
        return $this->numberClosPerMonth;
    }

    public function setNumberClosPerMonth(int $numberClosPerMonth): self
    {
        $this->numberClosPerMonth = $numberClosPerMonth;

        return $this;
    }

    public function getPrecisClosPerMonth(): ?string
    {
        return $this->precisClosPerMonth;
    }

    public function setPrecisClosPerMonth(?string $precisClosPerMonth): self
    {
        $this->precisClosPerMonth = $precisClosPerMonth;

        return $this;
    }

    public function getBudOfProspPerMonth(): ?int
    {
        return $this->budOfProspPerMonth;
    }

    public function setBudOfProspPerMonth(int $budOfProspPerMonth): self
    {
        $this->budOfProspPerMonth = $budOfProspPerMonth;

        return $this;
    }

    public function getPrcisBudProsMonth(): ?string
    {
        return $this->prcisBudProsMonth;
    }

    public function setPrcisBudProsMonth(?string $prcisBudProsMonth): self
    {
        $this->prcisBudProsMonth = $prcisBudProsMonth;

        return $this;
    }

    public function getAnalyseProspec(): ?bool
    {
        return $this->analyseProspec;
    }

    public function setAnalyseProspec(bool $analyseProspec): self
    {
        $this->analyseProspec = $analyseProspec;

        return $this;
    }

    public function getSatisfiedOfRoi(): ?bool
    {
        return $this->satisfiedOfRoi;
    }

    public function setSatisfiedOfRoi(bool $satisfiedOfRoi): self
    {
        $this->satisfiedOfRoi = $satisfiedOfRoi;

        return $this;
    }

    public function getPriorityCommercial(): ?array
    {
        return $this->priorityCommercial;
    }

    public function setPriorityCommercial(array $priorityCommercial): self
    {
        $this->priorityCommercial = $priorityCommercial;

        return $this;
    }

    public function getPrcisPrioCommercial(): ?string
    {
        return $this->prcisPrioCommercial;
    }

    public function setPrcisPrioCommercial(?string $prcisPrioCommercial): self
    {
        $this->prcisPrioCommercial = $prcisPrioCommercial;

        return $this;
    }
}
