<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class PaginationService
{

    private $entityClass;
    private $limite = 10;

    private $page = 1;
    private $manager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->manager = $entityManagerInterface;
    }
    public function getData($critere = [])
    {
        //calculer l'offset
        $offest = $this->page * $this->limite - $this->limite;
        //Demander le repository de trouver le repository
        $repository = $this->manager->getRepository($this->entityClass);
        $data = $repository->findBy([], $critere, $this->limite, $offest);
        // Renvoyer $les elements en questions
        return $data;
    }

    public function getPages()
    {
        $repository = $this->manager->getRepository($this->entityClass);
        $total = count($repository->findAll());
        $pages = ceil($total / $this->limite);
        return $pages;
    }

    public function getEntityClass()
    {
        return $this->entityClass;
    }

    public function setEntityClass($entityClass): self
    {
        $this->entityClass = $entityClass;

        return $this;
    }

    public function getLimite(): ?int
    {
        return $this->limite;
    }

    public function setLimite(int $limite): self
    {
        $this->limite = $limite;

        return $this;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }
}
