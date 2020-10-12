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
    /**
     * @var KernelBrowser
     */
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
