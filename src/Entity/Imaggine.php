<?php

namespace App\Entity;

use App\Repository\ImaggineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImaggineRepository::class)
 */
class Imaggine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $caption;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $linkImaggine;

    /**
     * @ORM\ManyToOne(targetEntity=Prodotto::class, inversedBy="imaggines")
     */
    private $produtto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(?string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function getLinkImaggine(): ?string
    {
        return $this->linkImaggine;
    }

    public function setLinkImaggine(string $linkImaggine): self
    {
        $this->linkImaggine = $linkImaggine;

        return $this;
    }

    public function getProdutto(): ?Prodotto
    {
        return $this->produtto;
    }

    public function setProdutto(?Prodotto $produtto): self
    {
        $this->produtto = $produtto;

        return $this;
    }
}
