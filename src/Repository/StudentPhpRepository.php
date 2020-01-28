<?php

namespace App\Repository;

use App\Entity\StudentPhp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StudentPhp|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentPhp|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentPhp[]    findAll()
 * @method StudentPhp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentPhpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentPhp::class);
    }

    // /**
    //  * @return StudentPhp[] Returns an array of StudentPhp objects
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
    public function findOneBySomeField($value): ?StudentPhp
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
