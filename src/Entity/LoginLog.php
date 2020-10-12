<?php

namespace App\Entity;

use App\Repository\LoginLogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * 文档链接 https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/login/auth.code2Session.html
 * @ORM\Entity(repositoryClass=LoginLogRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *          @ORM\Index(columns={"add_time"}),
 *          @ORM\Index(columns={"openid"}),
 *     },
 *     options={"comment"="登录成功日志记录"}
 *     )
 */
class LoginLog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32,
     *     options={"comment"="用户唯一标识"})
     */
    private $openid;

    /**
     * @ORM\Column(type="string", length=255,
     *     options={"comment"="会话密钥"})
     */
    private $sessionKey;

    /**
     * @ORM\Column(type="string", length=32, nullable=true,
     *     options={"comment"="用户在开放平台的唯一标识符，在满足 UnionID 下发条件的情况下会返回"})
     */
    private $unionid;

    /**
     * @ORM\Column(type="integer")
     */
    private $addTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOpenid(): ?string
    {
        return $this->openid;
    }

    public function setOpenid(string $openid): self
    {
        $this->openid = $openid;

        return $this;
    }

    public function getSessionKey(): ?string
    {
        return $this->sessionKey;
    }

    public function setSessionKey(string $sessionKey): self
    {
        $this->sessionKey = $sessionKey;

        return $this;
    }

    public function getUnionid(): ?string
    {
        return $this->unionid;
    }

    public function setUnionid(?string $unionid): self
    {
        $this->unionid = $unionid;

        return $this;
    }

    public function getAddTime(): ?int
    {
        return $this->addTime;
    }

    public function setAddTime(int $addTime): self
    {
        $this->addTime = $addTime;

        return $this;
    }
}
