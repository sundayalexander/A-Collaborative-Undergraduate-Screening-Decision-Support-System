<?php

namespace App\Repository;

use App\Entity\HealthService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HealthService|null find($id, $lockMode = null, $lockVersion = null)
 * @method HealthService|null findOneBy(array $criteria, array $orderBy = null)
 * @method HealthService[]    findAll()
 * @method HealthService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HealthServiceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HealthService::class);
    }

    // /**
    //  * @return HealthService[] Returns an array of HealthService objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HealthService
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
