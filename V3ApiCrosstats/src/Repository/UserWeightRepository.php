<?php

namespace App\Repository;

use App\Entity\UserWeight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserWeight|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserWeight|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserWeight[]    findAll()
 * @method UserWeight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserWeightRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserWeight::class);
    }

    // /**
    //  * @return UserWeight[] Returns an array of UserWeight objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserWeight
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
