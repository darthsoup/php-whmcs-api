<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Users extends AbstractApi
{
    public function addUser(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['language']);
        $resolver->setAllowedTypes('language', 'string');
        $resolver->setRequired(['firstname', 'lastname', 'email', 'password2']);

        return $this->send('AddUser', $resolver->resolve($parameters));
    }

    public function getUsers(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();

        return $this->send('GetUsers', $resolver->resolve($parameters));
    }
}
