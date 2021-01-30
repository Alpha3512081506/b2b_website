<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoriaRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=CategoriaRepository::class)
 * @UniqueEntity("nomeCategoria",
 *  message="La Categoria esiste già, Poi procedere ad agiungere i prodotti"
 * )
 */
class Categoria
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @NotBlank()
     * @Length(min=3,max=255)
     */
    private $nomeCategoria;

    /**
     * @ORM\OneToMany(targetEntity=Prodotto::class, mappedBy="categoria")
     */
    private $prodotti;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function __construct()
    {
        $this->prodotti = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeCategoria(): ?string
    {
        return $this->nomeCategoria;
    }

    public function setNomeCategoria(string $nomeCategoria): self
    {
        $this->nomeCategoria = $nomeCategoria;

        return $this;
    }

    /**
     * @return Collection|Prodotto[]
     */
    public function getProdotti(): Collection
    {
        return $this->prodotti;
    }

    public function addProdotti(Prodotto $prodotti): self
    {
        if (!$this->prodotti->contains($prodotti)) {
            $this->prodotti[] = $prodotti;
            $prodotti->setCategoria($this);
        }

        return $this;
    }

    public function removeProdotti(Prodotto $prodotti): self
    {
        if ($this->prodotti->removeElement($prodotti)) {
            // set the owning side to null (unless already changed)
            if ($prodotti->getCategoria() === $this) {
                $prodotti->setCategoria(null);
            }
        }

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
}
