<?php

namespace App\Entity;

use App\Repository\SocialMediaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SocialMediaRepository::class)
 */
class SocialMedia
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private ?string $linkedIn;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private ?string $facebook;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private ?string $tiktok;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private ?string $twitter;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private ?string $instagram;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private ?string $snapchat;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private ?string $youtube;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private ?string $pinterest;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private ?string $site;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="SocialMedias")
     * @ORM\JoinColumn(nullable=true)
     */
    private ?User $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLinkedIn(): ?string
    {
        return $this->linkedIn;
    }

    public function setLinkedIn(?string $linkedIn): self
    {
        $this->linkedIn = $linkedIn;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getTiktok(): ?string
    {
        return $this->tiktok;
    }

    public function setTiktok(?string $tiktok): self
    {
        $this->tiktok = $tiktok;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getSnapchat(): ?string
    {
        return $this->snapchat;
    }

    public function setSnapchat(?string $snapchat): self
    {
        $this->snapchat = $snapchat;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(?string $youtube): self
    {
        $this->youtube = $youtube;

        return $this;
    }

    public function getPinterest(): ?string
    {
        return $this->pinterest;
    }

    public function setPinterest(?string $pinterest): self
    {
        $this->pinterest = $pinterest;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(?string $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
