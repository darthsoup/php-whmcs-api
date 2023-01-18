<?php

declare(strict_types=1);

namespace DarthSoup\Tests\WhmcsApi;

use DarthSoup\WhmcsApi\Client;
use DarthSoup\WhmcsApi\HttpClient\Builder;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\AppendStream;
use GuzzleHttp\Psr7\Response;
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

    /** @dataProvider urlProvider */
    public function testWhmcsUrl(string $url, string $expected): void
    {
        $container = [];
        $history = Middleware::history($container);
        $handlerStack = HandlerStack::create(new MockHandler([new Response]));
        $handlerStack->push($history);

        $httpClient = new \GuzzleHttp\Client(['handler' => $handlerStack]);
        $builder = new Builder($httpClient);

        $client = new Client($builder);
        $client->url($url);

        $client->getHttpClient()->post('', [], new AppendStream);

        $this->assertCount(1, $container);

        /** @var \GuzzleHttp\Psr7\Request $request */
        $request = $container[0]['request'];
        $this->assertSame($expected, (string) $request->getUri());
    }

    public function urlProvider(): iterable
    {
        yield ['http://example.com/whmcs', 'http://example.com/whmcs/includes/api.php'];
        yield ['http://example.com/whmcs/', 'http://example.com/whmcs/includes/api.php'];
        yield ['http://whmcs.example.com', 'http://whmcs.example.com/includes/api.php'];
        yield ['http://whmcs.example.com/', 'http://whmcs.example.com/includes/api.php'];
    }
}
