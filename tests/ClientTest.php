<?php

declare(strict_types=1);

namespace DarthSoup\Tests\WhmcsApi;

use DarthSoup\WhmcsApi\Client;
use Http\Client\Common\HttpMethodsClient;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testIsCreatable()
    {
        $client = new Client();
        $client->url('http://example.com');
        $client->authenticate('username', 'password');

        $this->assertInstanceOf(Client::class, $client);
        $this->assertInstanceOf(HttpMethodsClient::class, $client->getHttpClient());
    }
}
