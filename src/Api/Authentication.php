<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Authentication extends AbstractApi
{
    public function listOAuthCredentials()
    {
        return $this->send('ListOAuthCredentials');
    }

    public function validateLogin(string $username, string $password)
    {
        return $this->send('ValidateLogin', ['username' => $username, 'password2' => $password]);
    }
}
