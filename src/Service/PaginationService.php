<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class PaginationService
{

    private $entityClass;
    private $limite = 10;

    private $currentPage = 1;
    private $manager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->manager = $entityManagerInterface;
    }
    public function getData()
    {
        //calculer l'offset
        $offest = $this->currentPage * $this->limite - $this->limite;
        //Demander le repository de trouver le repository
        $repository = $this->manager->getRepository($this->entityClass);
        $data = $repository->findBy([], [], $this->limite, $offest);
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

    public function getCurrentPage(): ?int
    {
        return $this->currentPage;
    }

    public function setCurrentPage(int $page): self
    {
        $this->currentPage = $page;

        return $this;
    }
}
