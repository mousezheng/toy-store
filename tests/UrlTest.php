<?php

/**
 * Created by : PhpStorm
 * User: mousezheng
 * Date: 2020/6/20
 * Time: 下午2:10
 */

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UrlTest extends WebTestCase
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
        $testContent = $this->save();
        self::assertIsInt($testContent['id']);
    }

    public function testGet()
    {
        $testContent = $this->save();
        self::assertIsInt($testContent['id']);
        $this->client->request('GET', sprintf('/url/toy/%d', $testContent['id']));
        $response        = $this->client->getResponse();
        $responseContent = json_decode($response->getContent(), true);
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals($testContent['url'], $responseContent['data']['url']);
        self::assertEquals($testContent['type'], $responseContent['data']['type']);
        self::assertEquals($testContent['redirect'], $responseContent['data']['redirect']);
    }

    public function testDelete()
    {
        $testContent = $this->save();
        self::assertIsInt($testContent['id']);
        $this->client->request('DELETE', sprintf('/url/toy/%d', $testContent['id']));
        $response = $this->client->getResponse();
        self::assertEquals(200, $response->getStatusCode());
        $this->client->request('GET', sprintf('/url/toy/%d', $testContent['id']));
        $response        = $this->client->getResponse();
        $responseContent = json_decode($response->getContent(), true);
        self::assertEquals(200, $response->getStatusCode());
        self::assertNull($responseContent['data']);
    }

    private function save(): array
    {
        $testContent = [
            "url"      => "https://github.com/mousezheng",
            "type"     => "link",
            "redirect" => 301
        ];
        $content     = json_encode($testContent);
        $this->client->request('Post', '/url/save', [], [], [], $content);
        $response        = $this->client->getResponse();
        $responseContent = json_decode($response->getContent(), true);
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals(0, $responseContent['code']);
        $testContent['id'] = $responseContent['data'] ?? null;
        return $testContent;
    }

    public function testRedirect()
    {
        $testContent = $this->save();
        self::assertIsInt($testContent['id']);
        $this->client->request('GET', sprintf('/url/redirect/%d', $testContent['id']));
        $response        = $this->client->getResponse();
        self::assertEquals($testContent['redirect'], $response->getStatusCode());
        self::assertEquals($testContent['url'], $response->headers->get('Location'));
    }
}
