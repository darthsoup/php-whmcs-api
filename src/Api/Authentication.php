<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Authentication extends AbstractApi
{
    public function createOAuthCredential(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['grantType', 'scope', 'name', 'serviceId', 'description', 'logoUri', 'redirectUri']);
        $resolver->setAllowedTypes('grantType', 'string');
        $resolver->setAllowedTypes('scope', 'string');
        $resolver->setRequired(['grantType', 'scope']);

        return $this->send('CreateOAuthCredential', $resolver->resolve($parameters));
    }

    public function createSsoToken(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['client_id', 'user_id', 'destination', 'service_id', 'domain_id', 'sso_redirect_path']);
        $resolver->setAllowedTypes('client_id', 'int');
        $resolver->setAllowedTypes('user_id', 'int');
        $resolver->setAllowedTypes('destination', 'string');
        $resolver->setAllowedTypes('service_id', 'int');
        $resolver->setAllowedTypes('domain_id', 'int');
        $resolver->setAllowedTypes('sso_redirect_path', 'string');

        return $this->send('CreateSsoToken', $resolver->resolve($parameters));
    }

    public function deleteOAuthCredential(int $credentialId)
    {
        return $this->send('DeleteOAuthCredential', ['credentialId' => $credentialId]);
    }

    public function listOAuthCredentials(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['grantType', 'sortField', 'limit']);
        $resolver->setDefined('limit')
            ->setAllowedTypes('limit', 'int')
            ->setAllowedValues('limit', fn($value): bool => $value > 0 && $value <= 250);

        return $this->send('ListOAuthCredentials', $resolver->resolve($parameters));
    }

    public function validateLogin(string $username, string $password)
    {
        return $this->send('ValidateLogin', ['username' => $username, 'password2' => $password]);
    }
}
