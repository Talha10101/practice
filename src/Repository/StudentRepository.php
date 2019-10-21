<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }


    public function findStudent()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('s.program','s.phone','s.age','s.gender','u.id','u.email','u.username')
            ->from(Student::class, 's');
        $qb->join('s.user ','u');
//            ->('u on s.id=u.id');
//            ->andWhere('A.type = :type')
//            ->setParameter("token", $token)
//            ->setParameter("type", $type);
//        var_dump($qb->getQuery()->getResult());die;
        $data = $qb->getQuery()->getResult();
        if(!empty($data))
        {
            return $data[0];
        }
        else return null;
    }

//

    /*
    public function findOneBySomeField($value): ?Student
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
