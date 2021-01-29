<?php

namespace App\Repository;

use App\Entity\PaginatorService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PaginatorService|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaginatorService|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaginatorService[]    findAll()
 * @method PaginatorService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaginatorServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaginatorService::class);
    }

    // /**
    //  * @return PaginatorService[] Returns an array of PaginatorService objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PaginatorService
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
