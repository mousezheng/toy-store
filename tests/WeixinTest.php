<?php

/**
 * Created by : PhpStorm
 * User: zsl
 * Date: 2020/10/12
 * Time: 17:44
 */

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WeixinTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp()
    {
        parent::setUp();
        $this->client = static::createClient();
    }

    public function testSave()
    {
        $id = $this->save();
        self::assertIsNumeric($id);
    }

    public function testGetInfo()
    {
        $query = [
            'openid' => 'oOmvP4vZTLuPxMDccaMY6bypF39Y'
        ];
        $this->client->request('GET', '/weixin/getInfo', $query);
        $response        = $this->client->getResponse();
        $responseContent = json_decode($response->getContent(), true);
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals(0, $responseContent['code']);
        self::assertArrayHasKey('id', $responseContent['data']);
        self::assertArrayHasKey('avatarUrl', $responseContent['data']);
        self::assertArrayHasKey('city', $responseContent['data']);
        self::assertArrayHasKey('country', $responseContent['data']);
        self::assertArrayHasKey('gender', $responseContent['data']);
        self::assertArrayHasKey('language', $responseContent['data']);
        self::assertArrayHasKey('nickName', $responseContent['data']);
        self::assertArrayHasKey('province', $responseContent['data']);
        self::assertArrayHasKey('openid', $responseContent['data']);
        self::assertIsNumeric($responseContent['data']['id']);
    }

    public function save(): int
    {
        $weixinUserInfo = [
            'avatarUrl' => 'https://thirdwx.qlogo.cn/mmopen/vi_32/H8dmUSrcLN6YDtf0L4RRn2opVjOI6IfNZuM3mPotNh2qKaWgXib6Am4MesZ92oic8JrSIiakrJRsrYf0EiaV1KAC1Q/132',
            'city'      => 'China',
            'country'   => 'Xi\'an',
            'gender'    => '1',
            'nickName'  => '鼠小',
            'openid'    => 'oOmvP4vZTLuPxMDccaMY6bypF39Y',
            'province'  => 'Shaanxi',
            'language'  => 'en',
        ];
        $content        = json_encode($weixinUserInfo);
        $this->client->request('POST', '/weixin/save', [], [], [], $content);
        $response        = $this->client->getResponse();
        $responseContent = json_decode($response->getContent(), true);
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals(0, $responseContent['code']);
        $id = $responseContent['data'] ?? null;
        return $id;
    }
}
