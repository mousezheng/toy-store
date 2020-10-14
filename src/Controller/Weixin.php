<?php

/**
 * Created by : PhpStorm
 * User: zsl
 * Date: 2020/10/12
 * Time: 15:47
 */

namespace App\Controller;

use App\Entity\WeixinUserInfo;
use App\Service\Weixin as WeixinService;
use Respect\Validation\Validator as v;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Url
 *
 * @package App\Controller
 * @Route("/weixin/")
 */
class Weixin
{
    private WeixinService $weixinService;

    public function __construct(WeixinService $weixinService)
    {
        $this->weixinService = $weixinService;
    }

    /**
     * @param array $content
     *
     * @return int
     * @Route("save", methods="POST")
     */
    public function save(array $content): int
    {
        $emptyValidator = v::not(v::notEmpty());
        $validator      = v::keySet(
            v::key('avatarUrl', v::anyOf(v::url(), $emptyValidator), false),
            v::key('city', v::anyOf(v::stringVal(), $emptyValidator), false),
            v::key('country', v::anyOf(v::stringVal(), $emptyValidator), false),
            v::key('gender', v::anyOf(v::in([1, 2, 0]), $emptyValidator), false),
            v::key('nickName', v::anyOf(v::stringVal(), $emptyValidator), false),
            v::key('openId', v::anyOf(v::stringVal(), $emptyValidator), false),
            v::key('province', v::anyOf(v::stringVal(), $emptyValidator), false),
            v::key('language', v::anyOf(v::in(['en', 'zh_CN', 'zh_TW']), $emptyValidator), false),
            v::key('unionId', v::anyOf(v::stringVal(), $emptyValidator), false)
        );
        $validator->assert($content);
        $weixinUserInfo = new WeixinUserInfo();
        $weixinUserInfo->setAvatarUrl($content['avatarUrl'] ?? null)
                       ->setCity($content['city'] ?? null)
                       ->setCountry($content['country'] ?? null)
                       ->setGender($content['gender'] ?? null)
                       ->setLanguage($content['language'] ?? null)
                       ->setNickName($content['nickName'] ?? null)
                       ->setProvince($content['province'] ?? null)
                       ->setOpenId($content['openId'] ?? null);
        return $this->weixinService->save($weixinUserInfo);
    }

    /**
     * @param array $query
     *
     * @return array|null
     * @Route("getInfo", methods="GET")
     */
    public function getInfo($query): ?array
    {
        $validator = v::keySet(
            v::key('openId', v::stringVal())
        );
        $validator->assert($query);
        return $this->weixinService->getInfo($query['openId']);
    }

    /**
     * @param array $query
     *
     * @return array
     * @Route("getSessionByCode", methods="GET")
     */
    public function getSessionByCode($query): array
    {
        $validator = v::keySet(
            v::key('code', v::stringVal())
        );
        $validator->assert($query);
        return $this->weixinService->getSessionByCode($query['code']);
    }
}
