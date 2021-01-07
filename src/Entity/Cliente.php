<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClienteRepository::class)
 */
class Cliente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomeCliente;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cognomeCliente;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $eta;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeCliente(): ?string
    {
        return $this->nomeCliente;
    }

    public function setNomeCliente(string $nomeCliente): self
    {
        $this->nomeCliente = $nomeCliente;

        return $this;
    }

    public function getCognomeCliente(): ?string
    {
        return $this->cognomeCliente;
    }

    public function setCognomeCliente(string $cognomeCliente): self
    {
        $this->cognomeCliente = $cognomeCliente;

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

    public function getEta(): ?int
    {
        return $this->eta;
    }

    public function setEta(int $eta): self
    {
        $this->eta = $eta;

        return $this;
    }
}
