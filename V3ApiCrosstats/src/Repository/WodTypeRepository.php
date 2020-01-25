<?php

namespace App\Repository;

use App\Entity\WodType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method WodType|null find($id, $lockMode = null, $lockVersion = null)
 * @method WodType|null findOneBy(array $criteria, array $orderBy = null)
 * @method WodType[]    findAll()
 * @method WodType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WodTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WodType::class);
    }

    // /**
    //  * @return WodType[] Returns an array of WodType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WodType
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
