<?php

namespace App\Repository;

use App\Entity\UserRoleId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserRoleId|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserRoleId|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserRoleId[]    findAll()
 * @method UserRoleId[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRoleIdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserRoleId::class);
    }

    // /**
    //  * @return UserRoleId[] Returns an array of UserRoleId objects
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
    public function findOneBySomeField($value): ?UserRoleId
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
