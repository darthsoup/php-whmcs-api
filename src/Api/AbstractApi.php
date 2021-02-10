<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

use DarthSoup\WhmcsApi\Client;
use DarthSoup\WhmcsApi\HttpClient\Formatter\ResponseFormatter;
use GuzzleHttp\Psr7\AppendStream;
use GuzzleHttp\Psr7\Utils;

abstract class AbstractApi
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $action
     * @param array $parameter
     * @return mixed|string
     */
    protected function send(string $action, array $parameter = [])
    {
        $header = [];
        $body = array_merge(['action' => $action], $parameter);

        $stream = new AppendStream([Utils::streamFor(http_build_query($body))]);

        $response = $this->client->getHttpClient()->post(
            '', // WHMCS doesnt use a specific url
            $header,
            $stream
        );

        return ResponseFormatter::format($response);
    }

    /**
     * @return Client
     */
    protected function getClient(): Client
    {
        return $this->client;
    }
}
