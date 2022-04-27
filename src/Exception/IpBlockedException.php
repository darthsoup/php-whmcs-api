<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Exception;

use RuntimeException;
use Throwable;

class IpBlockedException extends RuntimeException
{
    public function __construct(string $ip, int $code = 0, Throwable $previous = null)
    {
        parent::__construct("The access with ip [$ip] is currently blocked", $code, $previous);
    }
}
