<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\HttpClient\Plugin;

use GuzzleHttp\Psr7\AppendStream;
use GuzzleHttp\Psr7\Utils;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;

class WhmcsContentType implements Plugin
{
    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        /** @var AppendStream $stream */
        $stream = $request->getBody();

        $query = null !== $stream->getSize()
            ? '&' . http_build_query(['responsetype' => 'json'])
            : http_build_query(['responsetype' => 'json']);

        $stream->addStream(Utils::streamFor($query));

        $request = $request->withBody($stream);

        return $next($request);
    }
}
