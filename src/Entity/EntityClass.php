<?php

namespace App\Entity;

use App\Repository\EntityClassRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntityClassRepository::class)
 */
class EntityClass
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
    private $mm;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMm(): ?string
    {
        return $this->mm;
    }

    public function setMm(string $mm): self
    {
        $this->mm = $mm;

        return $this;
    }
}
