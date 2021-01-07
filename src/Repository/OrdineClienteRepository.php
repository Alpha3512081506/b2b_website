<?php

namespace App\Repository;

use App\Entity\OrdineCliente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrdineCliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdineCliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdineCliente[]    findAll()
 * @method OrdineCliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdineClienteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdineCliente::class);
    }

    // /**
    //  * @return OrdineCliente[] Returns an array of OrdineCliente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrdineCliente
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
