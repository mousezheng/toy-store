<?php

namespace App\Entity;

use App\Repository\WeixinUserInfoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WeixinUserInfoRepository::class)
 *
 * @ORM\Table(
 *     indexes={
 *          @ORM\Index(columns={"add_time"}),
 *          @ORM\Index(columns={"openid"}),
 *     },
 *     options={"comment"="微信用户信息"}
 * )
 */
class WeixinUserInfo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128, nullable=true,
     *     options={"comment"="用户昵称"})
     */
    private $nickName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true,
     *     options={"comment"="用户头像图片的 URL"})
     */
    private $avatarUrl;

    /**
     * @ORM\Column(type="integer", nullable=true,
     *     options={"comment"="用户性别 0-未知，1-男，2-女"})
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=64, nullable=true,
     *     options={"comment"="国家"})
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=64, nullable=true,
     *     options={"comment"="省份"})
     */
    private $province;

    /**
     * @ORM\Column(type="string", length=64, nullable=true,
     *     options={"comment"="城市"})
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=16, nullable=true,
     *     options={"comment"="显示 country，province，city 所用的语言，en-英文，zh_CN-简体中文，zh_TW-繁体中文"})
     */
    private $language;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $openid;

    /**
     * @ORM\Column(type="integer")
     */
    private $addTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickName(): ?string
    {
        return $this->nickName;
    }

    public function setNickName(?string $nickName): self
    {
        $this->nickName = $nickName;

        return $this;
    }

    public function getAvatarUrl(): ?string
    {
        return $this->avatarUrl;
    }

    public function setAvatarUrl(?string $avatarUrl): self
    {
        $this->avatarUrl = $avatarUrl;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(?int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(?string $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;

        return $this;
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
