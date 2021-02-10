<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Custom extends AbstractApi
{
    /**
     * Emulates a custom api route with magic __call
     *
     * @param $name
     * @param $arguments
     * @return mixed|string
     */
    public function __call($name, $arguments)
    {
        $name = ucfirst($name);
        $parameters = $arguments[0] ?? [];

        if (!is_array($parameters)) {
            throw new \InvalidArgumentException('The parameters has to be an array');
        }

        return $this->send($name, $parameters);
    }
}
