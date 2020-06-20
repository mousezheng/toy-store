<?php

/**
 * Created by : PhpStorm
 * User: mousezheng
 * Date: 2020/6/20
 * Time: 下午3:36
 */

namespace App\Service;

use App\Enum\RedirectType;
use App\Enum\UrlType;
use App\Repository\UrlRepository;

class Url
{
    /**
     * @var UrlRepository
     */
    private $urlRepository;

    /**
     * Url constructor.
     *
     * @param UrlRepository $urlRepository
     */
    public function __construct(UrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    /**
     * @param string       $urlInfo
     * @param UrlType      $type
     * @param RedirectType $redirect
     *
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(string $urlInfo, UrlType $type, RedirectType $redirect): int
    {
        $url = $this->urlRepository->add($urlInfo, $type->getValue(), $redirect->getValue());
        return $url->getId();
    }
}
