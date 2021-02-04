<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;

class ContentType implements Plugin
{
    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        if (!$request->hasHeader('Content-Type')) {
            $request = $request->withHeader('Content-Type', 'application/x-www-form-urlencoded');
        }

        return $next($request);
    }
}
