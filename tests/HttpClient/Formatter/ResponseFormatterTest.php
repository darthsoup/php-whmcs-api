<?php

declare(strict_types=1);

namespace DarthSoup\Tests\WhmcsApi\HttpClient\Formatter\ResponseFormatter;

use DarthSoup\WhmcsApi\HttpClient\Formatter\ResponseFormatter;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use PHPUnit\Framework\TestCase;
use function GuzzleHttp\Psr7\stream_for;

class ResponseFormatterTest extends TestCase
{
    public function testFormat()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json'],
            Utils::streamFor('{"result": "success"}')
        );

        $this->assertSame(['result' => 'success'], ResponseFormatter::format($response));
    }

    public function testFormatString()
    {
        $expected = '{"result": "success"}';

        $response = new Response(
            200,
            [],
            Utils::streamFor($expected)
        );

        $this->assertEquals($expected, ResponseFormatter::format($response));
    }

    public function testFormatWithInvalidResponseData()
    {
        $this->expectException(\JsonException::class);

        $response = new Response(
            200,
            ['Content-Type' => 'application/json'],
            Utils::streamFor('{"result": }')
        );

        ResponseFormatter::format($response);
    }

    public function testErrorMessage()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json'],
            Utils::streamFor('{"result": "error", "message": "GotMessage"}')
        );

        $message = ResponseFormatter::errorMessage($response);
        $this->assertIsString($message);
        $this->assertEquals('GotMessage', $message);
    }
}
