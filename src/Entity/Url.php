<?php

namespace App\Entity;

use App\Repository\UrlRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UrlRepository::class)
 */
class Url
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=65535, options={"comment"="存储链接详情"})
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=16, options={"comment"="重定向类型，eg: 301, 302, and so on"})
     */
    private $redirect;

    /**
     * @ORM\Column(type="string", length=32, options={"comment"="eg: link,img,file,and so on"})
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $addTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getRedirect(): ?string
    {
        return $this->redirect;
    }

    public function setRedirect(string $redirect): self
    {
        $this->redirect = $redirect;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
