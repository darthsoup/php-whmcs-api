<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Client extends AbstractApi
{
    /**
     * @see https://developers.whmcs.com/api-reference/addclient/
     */
    public function addClient(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'owner_user_id', 'firstname', 'lastname', 'companyname', 'email', 'address1', 'address2', 'city',
            'state', 'postcode', 'country', 'phonenumber', 'tax_id', 'password2', 'securityqid', 'securityqans',
            'currency', 'groupid', 'customfields', 'language', 'clientip', 'notes', 'marketingoptin',
            'noemail', 'skipvalidation',
        ]);
        $resolver->setRequired(['firstname', 'lastname', 'email', 'address1', 'city', 'state', 'postcode', 'country', 'phonenumber',]);

        return $this->send('AddClient', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/addcontact/
     */
    public function addContact(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'firstname', 'lastname', 'companyname', 'email', 'address1', 'address2', 'city', 'state', 'postcode',
            'country', 'phonenumber', 'tax_id',
        ]);
        $resolver->setRequired(['clientid']);

        return $this->send('AddContact', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/closeclient/
     */
    public function closeClient(int $clientId)
    {
        return $this->send('CloseClient', ['clientid' => $clientId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/deleteclient/
     */
    public function deleteClient(int $clientId, bool $deleteUsers = false, bool $deleteTransactions = false)
    {
        return $this->send('DeleteClient', [
            'clientid' => $clientId,
            'deleteusers' => $deleteUsers,
            'deletetransactions' => $deleteTransactions
        ]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/deletecontact/
     */
    public function deleteContact(int $contactId)
    {
        return $this->send('DeleteContact', ['contactid' => $contactId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getcancelledpackages/
     */
    public function getCancelledPackages(array $parameters = [])
    {
        return $this->send('GetCancelledPackages', $this->createOptionsResolver()->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getclientgroups/
     */
    public function getClientGroups()
    {
        return $this->send('GetClientGroups');
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getclientpassword/
     */
    public function getClientPassword(array $parameters = [])
    {
        return $this->send('GetClientPassword', $this->createOptionsResolver()->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getclients/
     */
    public function getClients(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setAllowedValues('orderby', ['id', 'invoicenumber', 'date', 'duedate', 'total', 'status']);

        return $this->send('GetClients', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getclientsaddons/
     */
    public function getClientsAddons(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['serviceid', 'clientid', 'addonid']);
        $resolver->setAllowedTypes('serviceid', 'int');
        $resolver->setAllowedTypes('clientid', 'int');
        $resolver->setAllowedTypes('addonid', 'int');

        return $this->send('GetClientsAddons', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getclientsdetails/
     */
    public function getClientsDetails(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['clientid', 'email', 'stats']);
        $resolver->setAllowedTypes('clientid', 'int');
        $resolver->setAllowedTypes('email', 'string');
        $resolver->setAllowedTypes('stats', 'bool');

        return $this->send('GetClientsDetails', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getclientsdomains/
     */
    public function getClientsDomains(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['clientid', 'domainid', 'domain']);
        $resolver->setAllowedTypes('clientid', 'int');
        $resolver->setAllowedTypes('domainid', 'int');
        $resolver->setAllowedTypes('domain', 'string');

        return $this->send('GetClientsDomains', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getclientsproducts/
     */
    public function getClientsProducts(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['clientid', 'serviceid', 'pid', 'domain', 'username2']);
        $resolver->setAllowedTypes('clientid', 'int');
        $resolver->setAllowedTypes('serviceid', 'int');
        $resolver->setAllowedTypes('pid', 'int');
        $resolver->setAllowedTypes('domain', 'string');
        $resolver->setAllowedTypes('username2', 'string');

        return $this->send('GetClientsProducts', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getcontacts/
     */
    public function getContacts(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['userid']);
        $resolver->setAllowedTypes('userid', 'int');

        return $this->send('GetContacts', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getemails/
     */
    public function getEmails(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['clientid', 'date', 'email']);
        $resolver->setAllowedTypes('clientid', 'int');
        $resolver->setAllowedTypes('date', 'string');
        $resolver->setRequired(['clientid']);

        return $this->send('GetEmails', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/updateclient/
     */
    public function updateClient(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'clientid', 'tax_id', 'currency', 'groupid', 'customfields', 'language', 'clientip', 'notes',
            'status', 'paymentmethod', 'marketingoptin', 'clearcreditcard', 'skipvalidation', 'latefeeoveride',
            'overideduenotices', 'taxexempt', 'separateinvoices', 'disableautocc', 'overrideautoclose',
        ]);
        $resolver->setAllowedTypes('clientid', 'int');
        $resolver->setAllowedValues('status', self::STATUS_CLIENT);

        /* only support clientid for now */
        $resolver->setRequired('clientid');

        return $this->send('UpdateClient', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/updatecontact/
     */
    public function updateContact(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['contactid']);
        $resolver->setAllowedTypes('contactid', 'int');
        $resolver->setRequired('contactid');

        return $this->send('UpdateContact', $resolver->resolve($parameters));
    }
}
