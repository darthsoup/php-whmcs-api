<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\HttpClient\Plugin;

use DarthSoup\WhmcsApi\Client;
use GuzzleHttp\Psr7\AppendStream;
use GuzzleHttp\Psr7\Utils;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use RuntimeException;

class AccessKey implements Plugin
{
    /**
     * @var string
     */
    private $accessKey;

    public function __construct(string $accessKey)
    {
        $this->accessKey = $accessKey;
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        /** @var AppendStream $stream */
        $stream = $request->getBody();

        $httpQuery = http_build_query(['accesskey' => $this->accessKey]);

        $query = null !== $stream->getSize()
            ? '&' . $httpQuery
            : $httpQuery;

        $stream->addStream(Utils::streamFor($query));

        $request = $request->withBody($stream);

        return $next($request);
    }
}
