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
     * @see https://developers.whmcs.com/api-reference/createclientinvite/
     */
    public function createClientInvite(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['client_id', 'email', 'permissions']);
        $resolver->setAllowedTypes('client_id', 'string');
        $resolver->setAllowedTypes('permissions', 'string');
        $resolver->setRequired(['client_id', 'email', 'permissions']);

        return $this->send('CreateClientInvite', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/deleteuserclient/
     */
    public function deleteUserClient(int $userId, int $clientId)
    {
        return $this->send('DeleteUserClient', [
            'user_id' => $userId,
            'client_id' => $clientId
        ]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getpermissionslist/
     */
    public function getPermissionsList(int $userId, int $clientId)
    {
        return $this->send('GetPermissionsList');
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getuserpermissions/
     */
    public function getUserPermissions(int $userId, int $clientId)
    {
        return $this->send('GetUserPermissions', [
            'user_id' => $userId,
            'client_id' => $clientId
        ]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getusers/
     */
    public function getUsers(array $parameters = [])
    {
        return $this->send('GetUsers', $this->createOptionsResolver()->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/updateuser/
     */
    public function updateUser(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['user_id', 'language']);
        $resolver->setAllowedTypes('user_id', 'string');
        $resolver->setRequired(['user_id']);

        return $this->send('UpdateUser', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/updateuserpermissions/
     */
    public function updateUserPermissions(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['user_id', 'client_id', 'permissions']);
        $resolver->setAllowedTypes('user_id', 'string');
        $resolver->setAllowedTypes('client_id', 'string');
        $resolver->setAllowedTypes('permissions', 'string');
        $resolver->setRequired(['user_id', 'client_id', 'permissions']);

        return $this->send('UpdateUserPermissions', $resolver->resolve($parameters));
    }
}
