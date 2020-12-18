<?php

namespace Tests;

use Losgif\YS7\YS7Auth;
use Losgif\YS7\YS7Client;
use PHPUnit\Framework\TestCase;

class YS7ClientTest extends TestCase
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGenerateYS7Client(): void
    {
        $appKey = 'ed0a9d20fa474984b583e7e57d61f13b';
        $appSecret = 'd489894f35fc2d49878f5101a2697a26';

        $auth = new YS7Auth($appKey, $appSecret);

        $client = new YS7Client($auth);

        var_dump($client->device()->list(0, 50));

        self::assertInstanceOf(YS7Client::class, $client);
    }
}