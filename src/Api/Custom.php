<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

use InvalidArgumentException;

class Custom extends AbstractApi
{
    /**
     * Emulates a custom api route with magic __call
     *
     * @return mixed|string
     */
    public function __call(string $name, $arguments)
    {
        $name = ucfirst($name);
        $parameters = $arguments[0] ?? [];

        if (!is_array($parameters)) {
            throw new InvalidArgumentException('The parameters must be an array.');
        }

        return $this->send($name, $parameters);
    }
}
