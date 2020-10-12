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

    public function add(WeixinUserInfo $weixinUserInfo): WeixinUserInfo
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $weixinUserInfo->setAddTime(time());
        $em->persist($weixinUserInfo);
        $em->flush();
        $em->commit();
        return $weixinUserInfo;
    }

    public function updateByOpenid(WeixinUserInfo $weixinUserInfo, WeixinUserInfo $weixinUserInfoEntity): WeixinUserInfo
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $weixinUserInfoEntity->setAvatarUrl($weixinUserInfo->getAvatarUrl())
                             ->setCity($weixinUserInfo->getCity())
                             ->setCountry($weixinUserInfo->getCountry())
                             ->setGender($weixinUserInfo->getGender())
                             ->setLanguage($weixinUserInfo->getLanguage())
                             ->setNickName($weixinUserInfo->getNickName())
                             ->setProvince($weixinUserInfo->getProvince());
        $em->flush();
        $em->commit();
        return $weixinUserInfo;
    }

    public function delete(WeixinUserInfo $weixinUserInfo)
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $em->remove($weixinUserInfo);
        $em->flush();
        $em->commit();
        return $weixinUserInfo;
    }

    public function findByOpenid(string $openid): ?WeixinUserInfo
    {
        return $this->findOneBy([
            'openid' => $openid
        ]);
    }
}
