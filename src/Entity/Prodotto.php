<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProdottoRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProdottoRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Prodotto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @NotBlank(message="il prodotto è obbligatorio")
     */
    private $nomeStile;

    /**
     * @ORM\Column(type="string", length=255)
     * @NotBlank(message="il marca è obbligatorio")
     * 
     */
    private $marca;

    /**
     * @ORM\Column(type="string", length=255)
     * @NotBlank(message="il modelloCP è obbligatorio")
     */
    private $modelloCPU;

    /**
     * @ORM\Column(type="string", length=255)
     * @NotBlank(message="i dimensioni del RAM è obbligatorio")
     */
    private $dimensioniRAM;

    /**
     * @ORM\Column(type="string", length=255)
     * @NotBlank()
     */
    private $colore;

    /**
     * @ORM\Column(type="string", length=255)
     * @NotBlank()
     */
    private $dimensioniSchermo;

    /**
     * @ORM\Column(type="text")
     * @NotBlank()
     */
    private $commento;

    /**
     * @ORM\Column(type="integer")
     * @NotBlank()
     */
    private $prezzo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Categoria::class, inversedBy="prodotti")
     */
    private $categoria;
    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $coverImage;

    /**
     * @ORM\OneToMany(targetEntity=PurchaseItem::class, mappedBy="product")
     */
    private $purchaseItems;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_At;

    public function __construct()
    {
        $this->imaggines = new ArrayCollection();
        $this->purchaseItems = new ArrayCollection();
    }
    /**
     * @ORM\PrePersist
     */
    public function presPersist()
    {
        if (empty($this->created_At)) {
            $this->created_At = new DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeStile(): ?string
    {
        return $this->nomeStile;
    }

    public function setNomeStile(string $nomeStile): self
    {
        $this->nomeStile = $nomeStile;

        return $this;
    }

    public function getMarca(): ?string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    public function getModelloCPU(): ?string
    {
        return $this->modelloCPU;
    }

    public function setModelloCPU(string $modelloCPU): self
    {
        $this->modelloCPU = $modelloCPU;

        return $this;
    }

    public function getDimensioniRAM(): ?string
    {
        return $this->dimensioniRAM;
    }

    public function setDimensioniRAM(string $dimensioniRAM): self
    {
        $this->dimensioniRAM = $dimensioniRAM;

        return $this;
    }

    public function getColore(): ?string
    {
        return $this->colore;
    }

    public function setColore(string $colore): self
    {
        $this->colore = $colore;

        return $this;
    }

    public function getDimensioniSchermo(): ?string
    {
        return $this->dimensioniSchermo;
    }

    public function setDimensioniSchermo(string $dimensioniSchermo): self
    {
        $this->dimensioniSchermo = $dimensioniSchermo;

        return $this;
    }

    public function getCommento(): ?string
    {
        return $this->commento;
    }

    public function setCommento(string $commento): self
    {
        $this->commento = $commento;

        return $this;
    }

    public function getPrezzo(): ?float
    {
        return $this->prezzo;
    }

    public function setPrezzo(float $prezzo): self
    {
        $this->prezzo = $prezzo;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * @return Collection|Imaggine[]
     */
    public function getImaggines(): Collection
    {
        return $this->imaggines;
    }

    public function addImaggine(Imaggine $imaggine): self
    {
        if (!$this->imaggines->contains($imaggine)) {
            $this->imaggines[] = $imaggine;
            $imaggine->setProdutto($this);
        }

        return $this;
    }

    public function removeImaggine(Imaggine $imaggine): self
    {
        if ($this->imaggines->removeElement($imaggine)) {
            // set the owning side to null (unless already changed)
            if ($imaggine->getProdutto() === $this) {
                $imaggine->setProdutto(null);
            }
        }

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    public function setCoverImage(string $coverImage): self
    {
        $this->coverImage = $coverImage;

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
            $purchaseItem->setProduct($this);
        }

        return $this;
    }

    public function removePurchaseItem(PurchaseItem $purchaseItem): self
    {
        if ($this->purchaseItems->removeElement($purchaseItem)) {
            // set the owning side to null (unless already changed)
            if ($purchaseItem->getProduct() === $this) {
                $purchaseItem->setProduct(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_At;
    }

    public function setCreatedAt(\DateTimeInterface $created_At): self
    {
        $this->created_At = $created_At;

        return $this;
    }
}
