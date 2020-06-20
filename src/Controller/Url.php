<?php

/**
 * Created by : PhpStorm
 * User: mousezheng
 * Date: 2020/6/20
 * Time: 下午1:55
 */

namespace App\Controller;

use App\Enum\RedirectType;
use App\Enum\UrlType;
use App\Service\Url as UrlService;
use Respect\Validation\Validator as v;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Url
 *
 * @package App\Controller
 * @Route("/url/")
 */
class Url extends AbstractController
{
    /**
     * @var UrlService
     */
    private $urlService;

    /**
     * Url constructor.
     *
     * @param UrlService $urlService
     */
    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    /**
     * @param array $content
     *
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @Route("save", methods="POST")
     */
    public function save(array $content): int
    {
        $validator = v::keySet(
            v::key('url', v::url()),
            v::key('type', v::in(UrlType::values())),
            v::key('redirect', v::in([301, 302]))
        );
        $validator->assert($content);
        [
            'url'      => $url,
            'type'     => $type,
            'redirect' => $redirect
        ] = $content;
        return $this->urlService->save($url, new UrlType($type), new RedirectType($redirect));
    }

    /**
     * @param int $id
     * @Route("toy/{id}", methods="DELETE")
     */
    public function delete(int $id)
    {

    }

    /**
     * @param int $id
     * @Route("toy/{id}", methods="GET")
     */
    public function geta(int $id)
    {

    }
}