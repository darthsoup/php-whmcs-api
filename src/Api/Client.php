<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Client extends AbstractApi
{
    public function getClients(array $params = [])
    {
        return $this->send('GetClients', $params);
    }

    public function addClient(array $params = [])
    {
        return $this->send('AddClient', $params);
    }

    public function addContact(array $params = [])
    {
        return $this->send('AddContact', $params);
    }

    public function closeClient(array $params = [])
    {
        return $this->send('CloseClient', $params);
    }

    public function deleteClient(array $params = [])
    {
        return $this->send('DeleteClient', $params);
    }

    public function deleteContact(array $params = [])
    {
        return $this->send('DeleteContact', $params);
    }

    public function getCancelledPackages(array $params = [])
    {
        return $this->send('GetCancelledPackages', $params);
    }

    public function getClientGroups(array $params = [])
    {
        return $this->send('GetClientGroups', $params);
    }

    public function getClientPassword(array $params = [])
    {
        return $this->send('GetClientPassword', $params);
    }

    public function getClientsAddons(array $params = [])
    {
        return $this->send('GetClientsAddons', $params);
    }

    public function getClientsDetails(array $params = [])
    {
        return $this->send('GetClientsDetails', $params);
    }

    public function getClientsDomains(array $params = [])
    {
        return $this->send('GetClientsDomains', $params);
    }

    public function getClientsProducts(array $params = [])
    {
        return $this->send('GetClientsProducts', $params);
    }

    public function getContacts(array $params = [])
    {
        return $this->send('GetContacts', $params);
    }

    public function getEmails(array $params = [])
    {
        return $this->send('GetEmails', $params);
    }

    public function updateClient(array $params = [])
    {
        return $this->send('UpdateClient', $params);
    }

    public function updateContact(array $params = [])
    {
        return $this->send('UpdateContact', $params);
    }
}
