<?php

/**
 * Created by : PhpStorm
 * User: mousezheng
 * Date: 2020/6/20
 * Time: 下午2:10
 */

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UrlTest extends WebTestCase
{
    public function testGet()
    {
        $client  = static::createClient();
        $content = json_encode([
            "url"      => "http://example.com",
            "type"     => "img",
            "redirect" => 301
        ]);
        $client->request('Post', '/url/save', [], [], [], $content);
        $responseContent = $client->getResponse()->getContent();
        $responseContent = json_decode($responseContent, true);
        self::assertEquals(200, $client->getResponse()->getStatusCode());
        self::assertEquals(0, $responseContent['code']);
        self::assertIsInt($responseContent['data']);
    }

    //    public function testPost()
    //    {
    //    }
    //
    //    public function testDelete()
    //    {
    //    }
}
