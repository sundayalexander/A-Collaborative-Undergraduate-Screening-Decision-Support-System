<?php

namespace App\Repository;

use App\Entity\Jamb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Jamb|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jamb|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jamb[]    findAll()
 * @method Jamb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JambRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Jamb::class);
    }

    // /**
    //  * @return Jamb[] Returns an array of Jamb objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Jamb
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
