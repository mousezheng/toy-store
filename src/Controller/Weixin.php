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
     * @Route("save", methods="POST")
     *
     * @return int
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
            v::key('openid', v::anyOf(v::stringVal(), $emptyValidator), false),
            v::key('province', v::anyOf(v::stringVal(), $emptyValidator), false),
            v::key('language', v::anyOf(v::in(['en', 'zh_CN', 'zh_TW']), $emptyValidator), false)
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
                       ->setOpenid($content['openid'] ?? null);
        return $this->weixinService->save($weixinUserInfo);
    }
}
