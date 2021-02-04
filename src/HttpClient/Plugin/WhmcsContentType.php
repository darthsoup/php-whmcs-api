<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use function GuzzleHttp\Psr7\stream_for;

class WhmcsContentType implements Plugin
{
    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $stream = $request->getBody();

        $query = null !== $stream->getSize()
            ? '&' . http_build_query(['responsetype' => 'json'])
            : http_build_query(['responsetype' => 'json']);

        $stream->addStream(stream_for($query));

        $request = $request->withBody($stream);

        return $next($request);
    }
}
