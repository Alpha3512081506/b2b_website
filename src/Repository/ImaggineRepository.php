<?php

namespace App\Repository;

use App\Entity\Imaggine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Imaggine|null find($id, $lockMode = null, $lockVersion = null)
 * @method Imaggine|null findOneBy(array $criteria, array $orderBy = null)
 * @method Imaggine[]    findAll()
 * @method Imaggine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImaggineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Imaggine::class);
    }

    // /**
    //  * @return Imaggine[] Returns an array of Imaggine objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Imaggine
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
