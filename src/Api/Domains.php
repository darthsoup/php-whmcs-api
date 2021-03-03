<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Domains extends AbstractApi
{
    public function domainRegister(array $parameters = [])
    {
        return $this->send(
            'DomainRegister',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function domainRenew(array $parameters = [])
    {
        return $this->send(
            'DomainRenew',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function domainWhois(string $domain)
    {
        return $this->send('DomainRenew', ['domain' => $domain]);
    }
}
