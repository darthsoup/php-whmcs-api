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
use function sprintf;

class Authentication implements Plugin
{
    private string $method;

    private string $identifier;

    private string $secret;

    public function __construct(string $method, string $identifier, string $secret)
    {
        $this->method = $method;
        $this->identifier = $identifier;
        $this->secret = $secret;
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        /** @var AppendStream $stream */
        $stream = $request->getBody();

        $query = null !== $stream->getSize()
            ? '&' . $this->buildAuth()
            : $this->buildAuth();

        $stream->addStream(Utils::streamFor($query));

        $request = $request->withBody($stream);

        return $next($request);
    }

    /**
     * @return string
     */
    private function buildAuth(): string
    {
        $authBag = [];
        switch ($this->method) {
            case Client::AUTH_API_CREDENTIALS:
                $authBag['identifier'] = $this->identifier;
                $authBag['secret'] = $this->secret;
                break;
            case Client::AUTH_LOGIN_CREDENTIALS:
                $authBag['username'] = $this->identifier;
                $authBag['password'] = md5($this->secret);
                break;
            default:
                throw new RuntimeException(sprintf('Authentication method "%s" does not exist.', $this->method));
        }

        return http_build_query($authBag);
    }
}
