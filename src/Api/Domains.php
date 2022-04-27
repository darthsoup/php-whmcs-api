<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Domains extends AbstractApi
{
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

    public function domainGetLockingStatus(int $domainId)
    {
        return $this->send('DomainGetLockingStatus', ['domainid' => $domainId]);
    }

    public function domainGetNameservers(int $domainId)
    {
        return $this->send('DomainGetNameservers', ['domainid' => $domainId]);
    }

    public function domainGetWhoisInfo(int $domainId)
    {
        return $this->send('DomainGetWhoisInfo', ['domainid' => $domainId]);
    }

    public function domainRegister(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['domainid', 'idnlanguage']);
        $resolver->setAllowedTypes('domainid', 'int');
        $resolver->setRequired(['domainid']);

        return $this->send('DomainRegister', $resolver->resolve($parameters));
    }

    public function domainRelease(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['domainid', 'newtag']);
        $resolver->setAllowedTypes('domainid', 'int');
        $resolver->setRequired(['domainid', 'newtag']);

        return $this->send('DomainRelease', $resolver->resolve($parameters));
    }

    public function domainRenew(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['domainid', 'regperiod']);
        $resolver->setAllowedTypes('domainid', 'int');
        $resolver->setRequired(['domainid']);

        return $this->send('DomainRenew', $resolver->resolve($parameters));
    }

    public function domainRequestEpp(int $domainId)
    {
        return $this->send('DomainRequestEPP', ['domainid' => $domainId]);
    }

    public function domainTransfer(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['domainid', 'eppcode']);
        $resolver->setAllowedTypes('eppcode', 'string');
        $resolver->setRequired(['domainid']);

        return $this->send('DomainTransfer', $resolver->resolve($parameters));
    }

    public function domainToggleIdProtect(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['domainid', 'idprotect']);
        $resolver->setAllowedTypes('domainid', 'int');
        $resolver->setAllowedTypes('idprotect', 'bool');
        $resolver->setRequired(['domainid']);

        return $this->send('DomainToggleIdProtect', $resolver->resolve($parameters));
    }

    public function domainUpdateLockingStatus(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['domainid', 'lockstatus']);
        $resolver->setAllowedTypes('domainid', 'int');
        $resolver->setAllowedTypes('lockstatus', 'bool');
        $resolver->setRequired(['domainid']);

        return $this->send('DomainUpdateLockingStatus', $resolver->resolve($parameters));
    }

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

    public function domainUpdateWhoisInfo(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['domainid', 'xml']);
        $resolver->setAllowedTypes('domainid', 'int');
        $resolver->setAllowedTypes('xml', 'string');
        $resolver->setRequired(['domainid', 'xml']);

        return $this->send('DomainUpdateWhoisInfo', $resolver->resolve($parameters));
    }

    public function domainWhois(string $domain)
    {
        return $this->send('DomainRenew', ['domain' => $domain]);
    }

    public function getRegistrars()
    {
        return $this->send('GetRegistrars');
    }

    public function getTldPricing(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['currencyid', 'clientid']);
        $resolver->setAllowedTypes('currencyid', 'int');
        $resolver->setAllowedTypes('clientid', 'int');

        return $this->send('GetTLDPricing', $resolver->resolve($parameters));
    }

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
