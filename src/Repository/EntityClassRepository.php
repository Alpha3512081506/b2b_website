<?php

namespace App\Repository;

use App\Entity\EntityClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EntityClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntityClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntityClass[]    findAll()
 * @method EntityClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntityClassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntityClass::class);
    }

    // /**
    //  * @return EntityClass[] Returns an array of EntityClass objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EntityClass
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
