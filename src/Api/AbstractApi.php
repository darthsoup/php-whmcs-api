<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

use DarthSoup\WhmcsApi\Client;
use DarthSoup\WhmcsApi\HttpClient\Formatter\ResponseFormatter;
use GuzzleHttp\Psr7\AppendStream;
use function GuzzleHttp\Psr7\stream_for;

abstract class AbstractApi
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    protected function send(string $action, array $params = [])
    {
        $uri = '';
        $header = [];
        $body = array_merge(['action' => $action], $params);

        $stream = new AppendStream([stream_for(http_build_query($body))]);

        $response = $this->client->getHttpClient()->post(
            $uri, $header, $stream
        );

        return ResponseFormatter::format($response);
    }

    protected function getClient(): Client
    {
        return $this->client;
    }
}
