<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Domains extends AbstractApi
{
    /**
     * @see https://developers.whmcs.com/api-reference/createorupdatetld/
     */
    public function createOrUpdateTLD(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'extension', 'id_protection', 'dns_management', 'email_forwarding', 'epp_required', 'auto_registrar',
            'group', 'currency_code', 'grace_period_days', 'grace_period_fee', 'redemption_period_days',
            'redemption_period_fee', 'register', 'renew', 'transfer', 'display_after',
        ]);
        $resolver->setAllowedTypes('extension', 'string');
        $resolver->setRequired(['extension']);

        return $this->send('CreateOrUpdateTLD', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/domaingetlockingstatus/
     */
    public function domainGetLockingStatus(int $domainId)
    {
        return $this->send('DomainGetLockingStatus', ['domainid' => $domainId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/domaingetnameservers/
     */
    public function domainGetNameservers(int $domainId)
    {
        return $this->send('DomainGetNameservers', ['domainid' => $domainId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/domaingetwhoisinfo/
     */
    public function domainGetWhoisInfo(int $domainId)
    {
        return $this->send('DomainGetWhoisInfo', ['domainid' => $domainId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/domainregister/
     */
    public function domainRegister(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['domainid', 'idnlanguage']);
        $resolver->setAllowedTypes('domainid', 'int');
        $resolver->setRequired(['domainid']);

        return $this->send('DomainRegister', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/domainrelease/
     */
    public function domainRelease(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['domainid', 'newtag']);
        $resolver->setAllowedTypes('domainid', 'int');
        $resolver->setRequired(['domainid', 'newtag']);

        return $this->send('DomainRelease', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/domainrenew/
     */
    public function domainRenew(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['domainid', 'regperiod']);
        $resolver->setAllowedTypes('domainid', 'int');
        $resolver->setRequired(['domainid']);

        return $this->send('DomainRenew', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/domainrequestepp/
     */
    public function domainRequestEpp(int $domainId)
    {
        return $this->send('DomainRequestEPP', ['domainid' => $domainId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/domaintransfer/
     */
    public function domainTransfer(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['domainid', 'eppcode']);
        $resolver->setAllowedTypes('eppcode', 'string');
        $resolver->setRequired(['domainid']);

        return $this->send('DomainTransfer', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/domaintoggleidprotect/
     */
    public function domainToggleIdProtect(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['domainid', 'idprotect']);
        $resolver->setAllowedTypes('domainid', 'int');
        $resolver->setAllowedTypes('idprotect', 'bool');
        $resolver->setRequired(['domainid']);

        return $this->send('DomainToggleIdProtect', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/domainupdatelockingstatus/
     */
    public function domainUpdateLockingStatus(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['domainid', 'lockstatus']);
        $resolver->setAllowedTypes('domainid', 'int');
        $resolver->setAllowedTypes('lockstatus', 'bool');
        $resolver->setRequired(['domainid']);

        return $this->send('DomainUpdateLockingStatus', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/domainupdatenameservers/
     */
    public function domainUpdateNameservers(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['domainid', 'ns1', 'ns2', 'n3', 'n4', 'ns5']);
        $resolver->setAllowedTypes('domainid', 'int');
        $resolver->setAllowedTypes('ns1', 'string');
        $resolver->setAllowedTypes('ns2', 'string');
        $resolver->setRequired(['domainid', 'ns1', 'ns2']);

        return $this->send('DomainUpdateNameservers', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/domainupdatewhoisinfo/
     */
    public function domainUpdateWhoisInfo(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['domainid', 'xml']);
        $resolver->setAllowedTypes('domainid', 'int');
        $resolver->setAllowedTypes('xml', 'string');
        $resolver->setRequired(['domainid', 'xml']);

        return $this->send('DomainUpdateWhoisInfo', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/domainwhois/
     */
    public function domainWhois(string $domain)
    {
        return $this->send('DomainRenew', ['domain' => $domain]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getregistrars/
     */
    public function getRegistrars()
    {
        return $this->send('GetRegistrars');
    }

    /**
     * @see https://developers.whmcs.com/api-reference/gettldpricing/
     */
    public function getTldPricing(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['currencyid', 'clientid']);
        $resolver->setAllowedTypes('currencyid', 'int');
        $resolver->setAllowedTypes('clientid', 'int');

        return $this->send('GetTLDPricing', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/updateclientdomain/
     */
    public function updateClientDomain(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'domainid', 'dnsmanagement', 'emailforwarding', 'idprotection', 'donotrenew', 'type', 'regdate',
            'nextduedate', 'expirydate', 'domain', 'firstpaymentamount', 'recurringamount', 'registrar', 'regperiod',
            'paymentmethod', 'subscriptionid', 'status', 'notes', 'promoid', 'autorecalc', 'updatens',
            'ns1', 'ns2', 'ns3', 'ns4', 'ns5',
        ]);
        $resolver->setAllowedTypes('domainid', 'int');
        $resolver->setAllowedValues('status', self::STATUS_PRODUCT);
        $resolver->setRequired(['domainid']);

        return $this->send('UpdateClientDomain', $resolver->resolve($parameters));
    }
}
