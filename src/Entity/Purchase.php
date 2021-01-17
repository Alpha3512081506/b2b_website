<?php

namespace App\Entity;

use DateTime;
use App\Entity\PurchaseItem;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PreFlush;
use Doctrine\ORM\Mapping\PrePersist;
use App\Repository\PurchaseRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=PurchaseRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Purchase
{
    public const STATUS_PENDING = "PENDING";
    public const STATUS_PAID = "PAID";
    // public const STATUS_CANCEL = "CANCEL";
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $total;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status = "PENDING";

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="purchases")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     * 
     */
    private $purchaseAt;

    /**
     * @ORM\OneToMany(targetEntity=PurchaseItem::class, mappedBy="purchase", orphanRemoval=true)
     * @var Collection<PurchaseItem>
     */
    private $purchaseItems;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $RagioneSociale;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $via;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    public function __construct()
    {
        $this->purchaseItems = new ArrayCollection();
    }
    /**
     * @ORM\PrePersist
     */
    public function presPersist()
    {
        if (empty($this->purchaseAt)) {
            $this->purchaseAt = new DateTime();
        }
    }
    /**
     * @ORM\PreFlush
     */
    public function presFlush()
    {

        $total = 1;
        foreach ($this->purchaseItems as $items) {
            $total += $items->getTotal();
        }
        $this->total = $total;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPurchaseAt(): ?\DateTimeInterface
    {
        return $this->purchaseAt;
    }

    public function setPurchaseAt(\DateTimeInterface $purchaseAt): self
    {
        $this->purchaseAt = $purchaseAt;

        return $this;
    }

    /**
     * @return Collection|PurchaseItem[]
     */
    public function getPurchaseItems(): Collection
    {
        return $this->purchaseItems;
    }

    public function addPurchaseItem(PurchaseItem $purchaseItem): self
    {
        if (!$this->purchaseItems->contains($purchaseItem)) {
            $this->purchaseItems[] = $purchaseItem;
            $purchaseItem->setPurchase($this);
        }

        return $this;
    }

    public function removePurchaseItem(PurchaseItem $purchaseItem): self
    {
        if ($this->purchaseItems->removeElement($purchaseItem)) {
            // set the owning side to null (unless already changed)
            if ($purchaseItem->getPurchase() === $this) {
                $purchaseItem->setPurchase(null);
            }
        }

        return $this;
    }

    public function getRagioneSociale(): ?string
    {
        return $this->RagioneSociale;
    }

    public function setRagioneSociale(string $RagioneSociale): self
    {
        $this->RagioneSociale = $RagioneSociale;

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

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
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
}
