<?php

namespace App\Repository;

use App\Entity\AdminUnit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AdminUnit|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdminUnit|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdminUnit[]    findAll()
 * @method AdminUnit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminUnitRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AdminUnit::class);
    }

    // /**
    //  * @return AdminUnit[] Returns an array of AdminUnit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdminUnit
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
