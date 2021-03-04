<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\HttpClient\Plugin;

use DarthSoup\WhmcsApi\Client;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use RuntimeException;
use function GuzzleHttp\Psr7\stream_for;

class Authentication implements Plugin
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var string
     */
    private $secret;

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
        $stream = $request->getBody();

        $query = null !== $stream->getSize()
            ? '&' . $this->buildAuth()
            : $this->buildAuth();

        $stream->addStream(stream_for($query));

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
                throw new RuntimeException(\sprintf('Authentication method "%s" not implemented.', $this->method));
        }

        return http_build_query($authBag);
    }
}
