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
    private UrlRepository $urlRepository;

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
     */
    public function save(string $urlInfo, UrlType $type, RedirectType $redirect): int
    {
        $url = $this->urlRepository->add($urlInfo, $type->getValue(), $redirect->getValue());
        return $url->getId();
    }

    /**
     * @param int $id
     *
     * @return array|null
     */
    public function get(int $id): ?array
    {
        $url = $this->urlRepository->get($id);
        if (!$url instanceof \App\Entity\Url) {
            return null;
        }
        return [
            'id'       => $url->getId(),
            'redirect' => $url->getRedirect(),
            'type'     => $url->getType(),
            'addTime'  => $url->getAddTime(),
            'url'      => $url->getUrl()
        ];
    }

    public function delete(int $id)
    {
        $this->urlRepository->delete($id);
    }
}
