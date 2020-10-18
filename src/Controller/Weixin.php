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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use UnexpectedValueException;

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
     * @param array            $content
     * @param SessionInterface $session
     *
     * @return int
     * @Route("saveUserInfo", methods="POST")
     */
    public function saveUserInfo(array $content, SessionInterface $session): int
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
        if (!$session->has('openId')) {
            throw new UnexpectedValueException('登录异常');
        }
        $openId = $session->get('openId');
        $validator->assert($content);
        $weixinUserInfo = new WeixinUserInfo();
        $weixinUserInfo->setAvatarUrl($content['avatarUrl'] ?? null)
                       ->setCity($content['city'] ?? null)
                       ->setCountry($content['country'] ?? null)
                       ->setGender($content['gender'] ?? null)
                       ->setLanguage($content['language'] ?? null)
                       ->setNickName($content['nickName'] ?? null)
                       ->setProvince($content['province'] ?? null)
                       ->setOpenId($openId);
        return $this->weixinService->saveUserInfo($weixinUserInfo);
    }

    /**
     * @param array            $query
     * @param SessionInterface $session
     *
     * @return array|null
     * @Route("getUserInfo", methods="GET")
     */
    public function getUserInfo($query, SessionInterface $session): ?array
    {
        $validator = v::keySet(
            v::key('openId', v::stringVal(), false)
        );
        $validator->assert($query);
        if (!$session->has('openId')) {
            throw new UnexpectedValueException('登录异常');
        }
        $openId = $session->get('openId');
        return $this->weixinService->getUserInfo($openId);
    }

    /**
     * @param array            $query
     * @param SessionInterface $session
     *
     * @return array
     * @Route("getSessionByCode", methods="GET")
     */
    public function getSessionByCode($query, SessionInterface $session): array
    {
        $validator = v::keySet(
            v::key('code', v::stringVal())
        );
        $validator->assert($query);
        $sessionInfo = $this->weixinService->getSessionByCode($query['code']);
        $session->set('openId', $sessionInfo['openId']);
        return $sessionInfo;
    }
}
