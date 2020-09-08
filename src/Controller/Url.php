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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Url
 *
 * @package App\Controller
 * @Route("/url/")
 */
class Url
{
    /**
     * @var UrlService
     */
    private UrlService $urlService;

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
        $this->urlService->delete($id);
    }

    /**
     * @param int $id
     *
     * @return array|null
     * @Route("toy/{id}", methods="GET")
     */
    public function get(int $id): ?array
    {
        return $this->urlService->get($id);
    }

    /**
     * @param int $id
     *
     * @return Response
     * @Route("redirect/{id}", methods="GET")
     */
    public function redirect(int $id): Response
    {
        $url = $this->urlService->get($id);
        return new Response(null, $url['redirect'], ['Location' => $url['url']]);
    }
}