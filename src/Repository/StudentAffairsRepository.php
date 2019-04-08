<?php

namespace App\Repository;

use App\Entity\StudentAffairs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StudentAffairs|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentAffairs|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentAffairs[]    findAll()
 * @method StudentAffairs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentAffairsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StudentAffairs::class);
    }

    // /**
    //  * @return StudentAffairs[] Returns an array of StudentAffairs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StudentAffairs
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
