<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 */
class Profil
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="profils")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $createAt;

    /**
     * @ORM\Column(type="string", length=9, nullable=true)
     * @Assert\Regex("/^\d{9}$/", message="Numéro SIREN non-valide.")
     */
    private ?string $numberSiren;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $sizeFirm;

    /**
     * @ORM\Column(type="integer")
     */
    private int $sectorFirm;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $numberSales;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $poleMarketing;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $numberMarketers;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $poleCommercial;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $numberCommercial;

    /**
     * @ORM\OneToOne(targetEntity=ProfilMarketing::class, mappedBy="profil", cascade={"persist", "remove"})
     */
    private ProfilMarketing $profilMarketing;

    /**
     * @ORM\OneToOne(targetEntity=ProfilCommercial::class, mappedBy="profil", cascade={"persist", "remove"})
     */
    private ProfilCommercial $profilCommercial;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreateAt(): \DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getNumberSiren(): ?string
    {
        return $this->numberSiren;
    }

    public function setNumberSiren(?string $numberSiren): self
    {
        $this->numberSiren = $numberSiren;

        return $this;
    }

    public function getSizeFirm(): ?int
    {
        return $this->sizeFirm;
    }

    public function setSizeFirm(?int $sizeFirm): self
    {
        $this->sizeFirm = $sizeFirm;

        return $this;
    }

    public function getSectorFirm(): ?int
    {
        return $this->sectorFirm;
    }

    public function setSectorFirm(int $sectorFirm): self
    {
        $this->sectorFirm = $sectorFirm;

        return $this;
    }

    public function getNumberSales(): ?int
    {
        return $this->numberSales;
    }

    public function setNumberSales(?int $numberSales): self
    {
        $this->numberSales = $numberSales;

        return $this;
    }

    public function getPoleMarketing(): ?bool
    {
        return $this->poleMarketing;
    }

    public function setPoleMarketing(?bool $poleMarketing): self
    {
        $this->poleMarketing = $poleMarketing;

        return $this;
    }

    public function getNumberMarketers(): ?int
    {
        return $this->numberMarketers;
    }

    public function setNumberMarketers(?int $numberMarketers): self
    {
        $this->numberMarketers = $numberMarketers;

        return $this;
    }

    public function getPoleCommercial(): ?bool
    {
        return $this->poleCommercial;
    }

    public function setPoleCommercial(?bool $poleCommercial): self
    {
        $this->poleCommercial = $poleCommercial;

        return $this;
    }

    public function getNumberCommercial(): ?int
    {
        return $this->numberCommercial;
    }

    public function setNumberCommercial(?int $numberCommercial): self
    {
        $this->numberCommercial = $numberCommercial;

        return $this;
    }


    public function getProfilMarketing(): ?ProfilMarketing
    {
        return $this->profilMarketing;
    }

    public function setProfilMarketing(ProfilMarketing $profilMarketing): self
    {
        // set the owning side of the relation if necessary
        if ($profilMarketing->getProfil() !== $this) {
            $profilMarketing->setProfil($this);
        }

        $this->profilMarketing = $profilMarketing;

        return $this;
    }

    public function getProfilCommercial(): ?ProfilCommercial
    {
        return $this->profilCommercial;
    }

    public function setProfilCommercial(ProfilCommercial $profilCommercial): self
    {
        // set the owning side of the relation if necessary
        if ($profilCommercial !== null && $profilCommercial->getProfil() !== $this) {
            $profilCommercial->setProfil($this);
        }

        $this->profilCommercial = $profilCommercial;

        return $this;
    }
}
