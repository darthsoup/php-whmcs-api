<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Users extends AbstractApi
{
    /**
     * @see https://developers.whmcs.com/api-reference/adduser/
     */
    public function addUser(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['language']);
        $resolver->setAllowedTypes('language', 'string');
        $resolver->setRequired(['firstname', 'lastname', 'email', 'password2']);

        return $this->send('AddUser', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getusers/
     */
    public function getUsers(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();

        return $this->send('GetUsers', $resolver->resolve($parameters));
    }
}
