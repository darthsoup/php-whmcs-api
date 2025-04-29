<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\HttpClient\Formatter;

use JsonException;
use Psr\Http\Message\ResponseInterface;

final class ResponseFormatter
{
    /**
     * @return mixed|string
     * @throws JsonException
     */
    public static function format(ResponseInterface $response)
    {
        $body = (string)$response->getBody();

        if (str_starts_with($response->getHeaderLine('Content-Type'), 'application/json')) {
            return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        }

        return $body;
    }

    public static function errorResult(ResponseInterface $response): ?string
    {
        try {
            $content = self::format($response);
        } catch (JsonException) {
            return null;
        }

        return $content['result'] ?? null;
    }

    public static function errorMessage(ResponseInterface $response): ?string
    {
        try {
            $content = self::format($response);
        } catch (JsonException) {
            return null;
        }

        return $content['message'] ?? null;
    }
}
