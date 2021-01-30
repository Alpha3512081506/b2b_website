<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 * fields={"email"},message="questa email è già utilizzata sul nostro sito")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @NotBlank
     * @Email
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Purchase::class, mappedBy="user")
     */
    private $purchases;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=255)
     * @NotBlank
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @NotBlank
     * @Length(min=3)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ragioneSociale;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $partitaIva;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $via;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $citta;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cap;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $referente;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codiceUnivoco;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_activated;

    public function __construct()
    {
        $this->purchases = new ArrayCollection();
    }
    /**
     * @ORM\PrePersist
     */
    public function presPersist()
    {
        if (empty($this->is_activated)) {
            $this->is_activated =  false;
        }
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
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFullName(): ?string
    {
        return $this->getLastName() . ' ' . $this->getFirstName();
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * @return Collection|Purchase[]
     */
    public function getPurchases(): Collection
    {
        return $this->purchases;
    }

    public function addPurchase(Purchase $purchase): self
    {
        if (!$this->purchases->contains($purchase)) {
            $this->purchases[] = $purchase;
            $purchase->setUser($this);
        }

        return $this;
    }

    public function removePurchase(Purchase $purchase): self
    {
        if ($this->purchases->removeElement($purchase)) {
            // set the owning side to null (unless already changed)
            if ($purchase->getUser() === $this) {
                $purchase->setUser(null);
            }
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getRagioneSociale(): ?string
    {
        return $this->ragioneSociale;
    }

    public function setRagioneSociale(string $ragioneSociale): self
    {
        $this->ragioneSociale = $ragioneSociale;

        return $this;
    }

    public function getPartitaIva(): ?string
    {
        return $this->partitaIva;
    }

    public function setPartitaIva(string $partitaIva): self
    {
        $this->partitaIva = $partitaIva;

        return $this;
    }

    public function getVia(): ?string
    {
        return $this->via;
    }

    public function setVia(string $via): self
    {
        $this->via = $via;

        return $this;
    }

    public function getCitta(): ?string
    {
        return $this->citta;
    }

    public function setCitta(string $citta): self
    {
        $this->citta = $citta;

        return $this;
    }

    public function getCap(): ?string
    {
        return $this->cap;
    }

    public function setCap(string $cap): self
    {
        $this->cap = $cap;

        return $this;
    }

    public function getReferente(): ?string
    {
        return $this->referente;
    }

    public function setReferente(string $referente): self
    {
        $this->referente = $referente;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getCodiceUnivoco(): ?string
    {
        return $this->codiceUnivoco;
    }

    public function setCodiceUnivoco(string $codiceUnivoco): self
    {
        $this->codiceUnivoco = $codiceUnivoco;

        return $this;
    }

    public function getIsActivated(): ?bool
    {
        return $this->is_activated;
    }

    public function setIsActivated(bool $is_activated): self
    {
        $this->is_activated = $is_activated;

        return $this;
    }
}
