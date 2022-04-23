<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Client extends AbstractApi
{
    public function addClient(array $parameters = [])
    {
        return $this->send(
            'AddClient',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function addContact(array $parameters = [])
    {
        return $this->send(
            'AddContact',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function sendMail(array $parameters = [])
    {
        return $this->send(
            'SendEmail',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function closeClient(int $clientId)
    {
        return $this->send(
            'CloseClient',
            ['clientid' => $clientId]
        );
    }

    public function deleteClient(int $clientId, bool $deleteUsers = false, bool $deleteTransactions = false)
    {
        return $this->send('DeleteClient', [
            'clientid' => $clientId,
            'deleteusers' => $deleteUsers,
            'deletetransactions' => $deleteTransactions
        ]);
    }

    public function deleteContact(int $contactId)
    {
        return $this->send('DeleteContact', ['contactid' => $contactId]);
    }

    public function getCancelledPackages(array $parameters = [])
    {
        return $this->send(
            'GetCancelledPackages',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function getClientGroups()
    {
        return $this->send('GetClientGroups');
    }

    public function getClientPassword(array $parameters = [])
    {
        return $this->send(
            'GetClientPassword',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function getClients(array $parameters = [])
    {
        return $this->send(
            'GetClients',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function getClientsAddons(array $parameters = [])
    {
        return $this->send(
            'GetClientsAddons',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function getClientsDetails(array $parameters = [])
    {
        return $this->send(
            'GetClientsDetails',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function getClientsDomains(array $parameters = [])
    {
        return $this->send(
            'GetClientsDomains',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function getClientsProducts(array $parameters = [])
    {
        return $this->send(
            'GetClientsProducts',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function getContacts(array $parameters = [])
    {
        return $this->send(
            'GetContacts',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function getEmails(int $clientId, array $parameters = [])
    {
        return $this->send(
            'GetEmails',
            array_merge(['clientId' => $clientId], $this->createOptionsResolver()->resolve($parameters))
        );
    }

    public function updateClient(array $parameters = [])
    {
        return $this->send(
            'UpdateClient',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function updateContact(array $parameters = [])
    {
        return $this->send(
            'UpdateContact',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }
}
