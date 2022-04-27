<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\HttpClient\Plugin;

use DarthSoup\WhmcsApi\Exception\AuthenticationException;
use DarthSoup\WhmcsApi\Exception\IpBlockedException;
use DarthSoup\WhmcsApi\HttpClient\Formatter\ResponseFormatter;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class ExceptionHandler implements Plugin
{
    public const ERROR_AUTH_FAILED = 'Authentication Failed';
    public const ERROR_AUTH_CREDENTIALS = 'Invalid or missing credentials';
    public const ERROR_AUTH_INVALID_PASSWORD = "Invalid password provided";
    public const ERROR_AUTH_INVALID_IP = "Invalid IP";
    public const ERROR_AUTH_DISABLED = "Administrator Account Disabled";
    public const ERROR_AUTH_DENIED = "Access Denied";
    public const ERROR_ACTION_EMPTY = "Empty action request";

    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $promise = $next($request);

        return $promise->then(function (ResponseInterface $response): ResponseInterface {
            $status = $response->getStatusCode();

            if ($status >= 400 && $status < 500) {
                throw self::transformMessageToException(
                    $status,
                    ResponseFormatter::errorMessage($response) ?? $response->getReasonPhrase()
                );
            }

            return $response;
        });
    }

    /**
     * @param int $status
     * @param string|null $message
     * @return AuthenticationException|RuntimeException
     */
    private static function transformMessageToException(int $status, ?string $message)
    {
        if (400 === $status && $message === self::ERROR_ACTION_EMPTY) {
            return new RuntimeException($message, $status);
        }

        if (400 === $status && strpos($message, self::ERROR_AUTH_INVALID_IP)) {
            return new IpBlockedException($message, $status);
        }

        if (403 === $status && ($message === self::ERROR_AUTH_FAILED || $message === self::ERROR_AUTH_CREDENTIALS)) {
            return new AuthenticationException($message, $status);
        }

        return new RuntimeException($message, $status);
    }
}
