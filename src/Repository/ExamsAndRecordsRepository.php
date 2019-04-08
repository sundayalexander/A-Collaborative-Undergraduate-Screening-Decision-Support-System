<?php

namespace App\Repository;

use App\Entity\ExamsAndRecords;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ExamsAndRecords|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamsAndRecords|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamsAndRecords[]    findAll()
 * @method ExamsAndRecords[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamsAndRecordsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExamsAndRecords::class);
    }

    // /**
    //  * @return ExamsAndRecords[] Returns an array of ExamsAndRecords objects
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
    public function findOneBySomeField($value): ?ExamsAndRecords
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
