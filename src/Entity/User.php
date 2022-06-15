<?php

namespace App\Entity;

use App\Entity\SocialMedia;
use App\Entity\Profil;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(message = "format d'email non-valide.")
     */
    private string $email;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $companyname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $domainname;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private ?string $businesssector;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Regex("/^\+?\d+$/", message="Numéro de téléphone non-valide.")
     */
    private ?string $phonenumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex("/^[0-9A-ZÀ-ÖÛÜŸ]+[\wÀ-ÖÛÜŸà-öûüÿ\-\.\,\s]*[0-9a-zà-öûüÿ]*$/",
     * message="Caractères interdits dans le nom de la ville.")
     */
    private ?string $adress;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Regex("/^\d{5}$/", message="Code postal non-valide.")
     */
    private ?string $postcode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex("/^[A-ZÀ-ÖÛÜŸ]+[A-ZÀ-ÖÛÜŸa-zà-öûüÿ\-\s]*[a-zà-öûüÿ]*$/",
     * message="Caractères interdits dans le nom de la ville.")
     */
    private ?string $city;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $advertisingbudget;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $marketarea;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $firstConnection;

    /**
     * @ORM\OneToMany(targetEntity=Profil::class, mappedBy="user")
     */
    private Collection $profils;

    /**
     * @ORM\OneToOne(targetEntity=SocialMedia::class, mappedBy="user", orphanRemoval=true)
     */
    private ?SocialMedia $socialMedias;

    /**
     * @ORM\OneToMany(targetEntity=RoadmapCheck::class, mappedBy="user", orphanRemoval=true)
     */
    private Collection $roadmapChecks;

    public function __construct()
    {
        $this->profils = new ArrayCollection();
        $this->roadmapChecks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        if ($this->getFirstConnection()) {
            $roles[] = 'ROLE_USER';
        } else {
            $roles[] = 'ROLE_FIRSTTIME';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCompanyname(): ?string
    {
        return $this->companyname;
    }

    public function setCompanyname(?string $companyname): self
    {
        $this->companyname = $companyname;

        return $this;
    }

    public function getDomainname(): ?string
    {
        return $this->domainname;
    }

    public function setDomainname(?string $domainname): self
    {
        $this->domainname = $domainname;

        return $this;
    }

    public function getBusinesssector(): ?string
    {
        return $this->businesssector;
    }

    public function setBusinesssector(?string $businesssector): self
    {
        $this->businesssector = $businesssector;

        return $this;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(?string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAdvertisingbudget(): ?float
    {
        return $this->advertisingbudget;
    }

    public function setAdvertisingbudget(?float $advertisingbudget): self
    {
        $this->advertisingbudget = $advertisingbudget;

        return $this;
    }

    public function getMarketarea(): ?string
    {
        return $this->marketarea;
    }

    public function setMarketarea(?string $marketarea): self
    {
        $this->marketarea = $marketarea;

        return $this;
    }

    public function getFirstConnection(): ?bool
    {
        return $this->firstConnection;
    }

    public function setFirstConnection(bool $firstConnection): self
    {
        $this->firstConnection = $firstConnection;

        return $this;
    }
    /**
     * @return Collection|Profil[]
     */
    public function getProfils(): Collection
    {
        return $this->profils;
    }

    public function addProfil(Profil $profil): self
    {
        if (!$this->profils->contains($profil)) {
            $this->profils[] = $profil;
            $profil->setUser($this);
        }

        return $this;
    }

    /**
     * @return ?SocialMedia
     */
    public function getSocialMedias(): ?SocialMedia
    {
        return $this->socialMedias;
    }

    public function setSocialMedias(SocialMedia $socialMedias): self
    {
        if ($socialMedias->getUser() !== $this) {
            $socialMedias->setUser($this);
        }
        $this->socialMedias = $socialMedias;
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
            $roadmapCheck->setUser($this);
        }

        return $this;
    }

    public function removeRoadmapCheck(RoadmapCheck $roadmapCheck): self
    {
        if ($this->roadmapChecks->removeElement($roadmapCheck)) {
            // set the owning side to null (unless already changed)
            if ($roadmapCheck->getUser() === $this) {
                $roadmapCheck->setUser(null);
            }
        }

        return $this;
    }
}
