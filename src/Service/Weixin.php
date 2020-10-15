<?php

/**
 * Created by : PhpStorm
 * User: zsl
 * Date: 2020/10/12
 * Time: 15:56
 */

namespace App\Service;

use App\Entity\WeixinUserInfo;
use App\Repository\WeixinUserInfoRepository;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;

class Weixin
{
    private WeixinUserInfoRepository $weixinUserInfoRepo;
    private string                   $appId;
    private string                   $appSecret;

    public function __construct(WeixinUserInfoRepository $weixinUserInfoRepo, string $appId, string $appSecret)
    {
        $this->weixinUserInfoRepo = $weixinUserInfoRepo;
        $this->appId              = $appId;
        $this->appSecret          = $appSecret;
    }

    public function saveUserInfo(WeixinUserInfo $weixinUserInfo)
    {
        $weixinUserInfoEntity = $this->weixinUserInfoRepo->findByOpenId($weixinUserInfo->getOpenId());
        if ($weixinUserInfoEntity === null) {
            $weixinUserInfoEntity = $this->weixinUserInfoRepo->add($weixinUserInfo);
        } else {
            $this->weixinUserInfoRepo->updateByOpenId($weixinUserInfo, $weixinUserInfoEntity);
        }
        return $weixinUserInfoEntity->getId();
    }

    public function getUserInfo(string $openId): ?array
    {
        $weixinUserInfoEntity = $this->weixinUserInfoRepo->findByOpenId($openId);
        return [
            'id'        => $weixinUserInfoEntity->getId(),
            'avatarUrl' => $weixinUserInfoEntity->getAvatarUrl(),
            'city'      => $weixinUserInfoEntity->getCity(),
            'country'   => $weixinUserInfoEntity->getCountry(),
            'gender'    => $weixinUserInfoEntity->getGender(),
            'language'  => $weixinUserInfoEntity->getLanguage(),
            'nickName'  => $weixinUserInfoEntity->getNickName(),
            'province'  => $weixinUserInfoEntity->getProvince(),
            'openId'    => $weixinUserInfoEntity->getOpenId()
        ];
    }

    /**
     * @inheritDoc https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/login/auth.code2Session.html
     * @param string $code
     *
     * @return array
     */
    public function getSessionByCode(string $code): array
    {
        $query  = [
            'appid'      => $this->appId,
            'secret'     => $this->appSecret,
            'js_code'    => $code,
            'grant_type' => 'authorization_code',
        ];
        $client = HttpClient::create()->request(
            'GET',
            sprintf("%s?%s", 'https://api.weixin.qq.com/sns/jscode2session', http_build_query($query)),
        );
        if ($client->getStatusCode() === Response::HTTP_OK) {
            return json_decode($client->getContent(), true);
        } else {
            return [];
        }
    }
}
