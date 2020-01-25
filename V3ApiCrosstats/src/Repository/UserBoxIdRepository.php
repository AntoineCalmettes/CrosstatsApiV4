<?php

namespace App\Repository;

use App\Entity\UserBoxId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserBoxId|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserBoxId|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserBoxId[]    findAll()
 * @method UserBoxId[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserBoxIdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserBoxId::class);
    }

    // /**
    //  * @return UserBoxId[] Returns an array of UserBoxId objects
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
    public function findOneBySomeField($value): ?UserBoxId
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
