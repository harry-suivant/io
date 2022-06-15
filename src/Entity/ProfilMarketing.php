<?php

namespace App\Entity;

use App\Repository\ProfilMarRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfilMarRepository::class)
 */
class ProfilMarketing
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
    private string $messageForTarget;

    /**
     * @ORM\Column(type="array")
     */
    private array $socialNetworkUsed = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $prcSocialNetworkUse;

    /**
     * @ORM\Column(type="integer")
     */
    private int $socialNetworkEngage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $prcSocialNetworkEn;

    /**
     * @ORM\Column(type="array")
     */
    private array $actionSeaMep = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $prcActionSeaMep;

    /**
     * @ORM\Column(type="array")
     */
    private array $actionSeoMep = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $prcActionSeoMep;

    /**
     * @ORM\Column(type="array")
     */
    private array $socialNetworkBestRoi = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $prcSNBestRoi;

    /**
     * @ORM\Column(type="integer")
     */
    private int $vectorMarketing;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $prcVectorMarketing;

    /**
     * @ORM\Column(type="array")
     */
    private array $priorityMarketing = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $prcPriorityMarketing;

    /**
     * @ORM\OneToOne(targetEntity=Profil::class, inversedBy="profilMarketing", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private Profil $profil;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessageForTarget(): ?string
    {
        return $this->messageForTarget;
    }

    public function setMessageForTarget(string $messageForTarget): self
    {
        $this->messageForTarget = $messageForTarget;

        return $this;
    }

    public function getSocialNetworkUsed(): ?array
    {
        return $this->socialNetworkUsed;
    }

    public function setSocialNetworkUsed(array $socialNetworkUsed): self
    {
        $this->socialNetworkUsed = $socialNetworkUsed;

        return $this;
    }

    public function getPrcSocialNetworkUse(): ?string
    {
        return $this->prcSocialNetworkUse;
    }

    public function setPrcSocialNetworkUse(?string $prcSocialNetworkUse): self
    {
        $this->prcSocialNetworkUse = $prcSocialNetworkUse;

        return $this;
    }

    public function getSocialNetworkEngage(): ?int
    {
        return $this->socialNetworkEngage;
    }

    public function setSocialNetworkEngage(int $socialNetworkEngage): self
    {
        $this->socialNetworkEngage = $socialNetworkEngage;

        return $this;
    }

    public function getPrcSocialNetworkEn(): ?string
    {
        return $this->prcSocialNetworkEn;
    }

    public function setPrcSocialNetworkEn(?string $prcSocialNetworkEn): self
    {
        $this->prcSocialNetworkEn = $prcSocialNetworkEn;

        return $this;
    }

    public function getActionSeaMep(): ?array
    {
        return $this->actionSeaMep;
    }

    public function setActionSeaMep(array $actionSeaMep): self
    {
        $this->actionSeaMep = $actionSeaMep;

        return $this;
    }

    public function getPrcActionSeaMep(): ?string
    {
        return $this->prcActionSeaMep;
    }

    public function setPrcActionSeaMep(?string $prcActionSeaMep): self
    {
        $this->prcActionSeaMep = $prcActionSeaMep;

        return $this;
    }

    public function getActionSeoMep(): ?array
    {
        return $this->actionSeoMep;
    }

    public function setActionSeoMep(array $actionSeoMep): self
    {
        $this->actionSeoMep = $actionSeoMep;

        return $this;
    }

    public function getPrcActionSeoMep(): ?string
    {
        return $this->prcActionSeoMep;
    }

    public function setPrcActionSeoMep(?string $prcActionSeoMep): self
    {
        $this->prcActionSeoMep = $prcActionSeoMep;

        return $this;
    }

    public function getSocialNetworkBestRoi(): ?array
    {
        return $this->socialNetworkBestRoi;
    }

    public function setSocialNetworkBestRoi(array $socialNetworkBestRoi): self
    {
        $this->socialNetworkBestRoi = $socialNetworkBestRoi;

        return $this;
    }

    public function getPrcSNBestRoi(): ?string
    {
        return $this->prcSNBestRoi;
    }

    public function setPrcSNBestRoi(?string $prcSNBestRoi): self
    {
        $this->prcSNBestRoi = $prcSNBestRoi;

        return $this;
    }

    public function getVectorMarketing(): ?int
    {
        return $this->vectorMarketing;
    }

    public function setVectorMarketing(int $vectorMarketing): self
    {
        $this->vectorMarketing = $vectorMarketing;

        return $this;
    }

    public function getPrcVectorMarketing(): ?string
    {
        return $this->prcVectorMarketing;
    }

    public function setPrcVectorMarketing(?string $prcVectorMarketing): self
    {
        $this->prcVectorMarketing = $prcVectorMarketing;

        return $this;
    }

    public function getPriorityMarketing(): ?array
    {
        return $this->priorityMarketing;
    }

    public function setPriorityMarketing(array $priorityMarketing): self
    {
        $this->priorityMarketing = $priorityMarketing;

        return $this;
    }

    public function getPrcPriorityMarketing(): ?string
    {
        return $this->prcPriorityMarketing;
    }

    public function setPrcPriorityMarketing(?string $prcPriorityMarketing): self
    {
        $this->prcPriorityMarketing = $prcPriorityMarketing;

        return $this;
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
}
