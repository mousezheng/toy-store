<?php

namespace App\Repository;

use App\Entity\Url;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\LockMode;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Url|null find($id, $lockMode = null, $lockVersion = null)
 * @method Url|null findOneBy(array $criteria, array $orderBy = null)
 * @method Url[]    findAll()
 * @method Url[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UrlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Url::class);
    }

    /**
     * @param string $urlInfo
     * @param string $type
     * @param string $redirect
     *
     * @return Url
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function add(string $urlInfo, string $type, string $redirect): Url
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $url = new Url();
        $url->setAddTime(time())
            ->setUrl($urlInfo)
            ->setType($type)
            ->setRedirect($redirect);
        $em->persist($url);
        $em->flush();
        $em->commit();
        return $url;
    }

    /**
     * @param int $id
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(int $id)
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $url = $this->find($id, LockMode::PESSIMISTIC_WRITE);
        if (!$url instanceof Url) {
            return;
        }
        $em->remove($url);
        $em->flush();
        $em->commit();
    }

    /**
     * @param int $id
     *
     * @return Url|null
     */
    public function get(int $id): ?Url
    {
        return $this->find($id);
    }
}
