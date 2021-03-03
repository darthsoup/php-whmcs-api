<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Users extends AbstractApi
{
    public function addUsers(array $parameters = [])
    {
        return $this->send(
            'addUsers',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function getUsers(array $parameters = [])
    {
        return $this->send(
            'GetUsers',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }
}
