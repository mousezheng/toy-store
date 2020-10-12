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

class Weixin
{
    private WeixinUserInfoRepository $weixinUserInfoRepo;

    public function __construct(WeixinUserInfoRepository $weixinUserInfoRepo)
    {
        $this->weixinUserInfoRepo = $weixinUserInfoRepo;
    }

    public function save(WeixinUserInfo $weixinUserInfo)
    {
        $weixinUserInfoEntity = $this->weixinUserInfoRepo->findByOpenid($weixinUserInfo->getOpenid());
        if ($weixinUserInfoEntity === null) {
            $weixinUserInfoEntity = $this->weixinUserInfoRepo->add($weixinUserInfo);
        } else {
            $this->weixinUserInfoRepo->updateByOpenid($weixinUserInfo, $weixinUserInfoEntity);
        }
        return $weixinUserInfoEntity->getId();
    }

    public function getInfo(string $openid): ?WeixinUserInfo
    {
        return $this->weixinUserInfoRepo->findByOpenid($openid);
    }
}
