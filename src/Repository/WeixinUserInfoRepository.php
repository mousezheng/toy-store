<?php

namespace App\Repository;

use App\Entity\WeixinUserInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WeixinUserInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeixinUserInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeixinUserInfo[]    findAll()
 * @method WeixinUserInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeixinUserInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeixinUserInfo::class);
    }

    // /**
    //  * @return WeixinUserInfo[] Returns an array of WeixinUserInfo objects
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
    public function findOneBySomeField($value): ?WeixinUserInfo
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
