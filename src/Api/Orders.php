<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Orders extends AbstractApi
{
    public function acceptOrder(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined('orderid')
            ->setAllowedTypes('orderid', 'int');
        $resolver->setDefined('serverid')
            ->setAllowedTypes('serverid', 'int');
        $resolver->setDefined('serviceusername')
            ->setAllowedTypes('serviceusername', 'string');
        $resolver->setDefined('servicepassword')
            ->setAllowedTypes('servicepassword', 'string');
        $resolver->setDefined('registrar')
            ->setAllowedTypes('registrar', 'string');
        $resolver->setDefined('sendregistrar')
            ->setAllowedTypes('sendregistrar', 'bool');
        $resolver->setDefined('autosetup')
            ->setAllowedTypes('autosetup', 'bool');
        $resolver->setDefined('sendemail')
            ->setAllowedTypes('sendemail', 'bool');

        $resolver->setRequired('orderid');

        return $this->send('AcceptOrder', $resolver->resolve($parameters));
    }

    public function addOrder(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();

        $resolver->setDefined('clientid')
            ->setAllowedTypes('clientid', 'int');
        $resolver->setDefined('paymentmethod')
            ->setAllowedTypes('paymentmethod', 'string');
        $resolver->setDefined('pid')
            ->setAllowedTypes('pid', 'int[]');
        $resolver->setDefined('billingcycle')
            ->setAllowedTypes('billingcycle', 'string[]');
        $resolver->setDefined('domaintype')
            ->setAllowedTypes('domaintype', 'string[]');
        $resolver->setDefined('regperiod')
            ->setAllowedTypes('regperiod', 'int[]');
        $resolver->setDefined('idnlanguage')
            ->setAllowedTypes('idnlanguage', 'string[]');
        $resolver->setDefined('eppcode')
            ->setAllowedTypes('eppcode', 'string[]');
        $resolver->setDefined('nameserver1')
            ->setAllowedTypes('nameserver1', 'string');
        $resolver->setDefined('nameserver2')
            ->setAllowedTypes('nameserver2', 'string');
        $resolver->setDefined('nameserver3')
            ->setAllowedTypes('nameserver3', 'string');
        $resolver->setDefined('nameserver4')
            ->setAllowedTypes('nameserver4', 'string');
        $resolver->setDefined('nameserver5')
            ->setAllowedTypes('nameserver5', 'string');
        $resolver->setDefined('customfields')
            ->setAllowedTypes('customfields', 'string[]');
        $resolver->setDefined('configoptions')
            ->setAllowedTypes('configoptions', 'string[]');
        $resolver->setDefined('priceoverride')
            ->setAllowedTypes('priceoverride', 'float[]');
        $resolver->setDefined('promocode')
            ->setAllowedTypes('promocode', 'string');
        $resolver->setDefined('promooverride')
            ->setAllowedTypes('promooverride', 'bool');
        $resolver->setDefined('affid')
            ->setAllowedTypes('affid', 'int');
        $resolver->setDefined('noinvoice')
            ->setAllowedTypes('noinvoice', 'bool');
        $resolver->setDefined('noinvoiceemail')
            ->setAllowedTypes('noinvoiceemail', 'bool');
        $resolver->setDefined('noemail')
            ->setAllowedTypes('noemail', 'bool');
        $resolver->setDefined('addons')
            ->setAllowedTypes('addons', 'string[]');
        $resolver->setDefined('hostname')
            ->setAllowedTypes('hostname', 'string[]');
        $resolver->setDefined('ns1prefix')
            ->setAllowedTypes('ns1prefix', 'string[]');
        $resolver->setDefined('ns2prefix')
            ->setAllowedTypes('ns2prefix', 'string[]');
        $resolver->setDefined('rootpw')
            ->setAllowedTypes('rootpw', 'string[]');
        $resolver->setDefined('contactid')
            ->setAllowedTypes('contactid', 'int');
        $resolver->setDefined('dnsmanagement')
            ->setAllowedTypes('dnsmanagement', 'bool[]');
        $resolver->setDefined('domainfields')
            ->setAllowedTypes('domainfields', 'string[]');
        $resolver->setDefined('emailforwarding')
            ->setAllowedTypes('emailforwarding', 'bool[]');
        $resolver->setDefined('idprotection')
            ->setAllowedTypes('idprotection', 'bool[]');
        $resolver->setDefined('domainpriceoverride')
            ->setAllowedTypes('domainpriceoverride', 'float[]');
        $resolver->setDefined('domainrenewoverride')
            ->setAllowedTypes('domainrenewoverride', 'float[]');
        $resolver->setDefined('domainrenewals')
            ->setAllowedTypes('domainrenewals', 'array');
        $resolver->setDefined('addonid')
            ->setAllowedTypes('addonid', 'int');
        $resolver->setDefined('serviceid')
            ->setAllowedTypes('serviceid', 'int');
        $resolver->setDefined('addonids')
            ->setAllowedTypes('addonids', 'int[]');
        $resolver->setDefined('serviceids')
            ->setAllowedTypes('serviceids', 'int[]');

        $resolver->setRequired(['clientId', 'paymentmethod']);

        return $this->send('AddOrder', $resolver->resolve($parameters));
    }

    public function cancelOrder(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();

        $resolver->setDefined('orderid')
            ->setAllowedTypes('orderid', 'int');
        $resolver->setDefined('cancelsub')
            ->setAllowedTypes('cancelsub', 'bool');
        $resolver->setDefined('noemail')
            ->setAllowedTypes('noemail', 'bool');

        $resolver->setRequired(['orderid']);

        return $this->send('CancelOrder', $resolver->resolve($parameters));
    }

    public function deleteOrder(int $orderId)
    {
        return $this->send('DeleteOrder', ['orderid' => $orderId]);
    }

    public function fraudOrder(int $orderId, bool $cancelSub = false)
    {
        return $this->send('FraudOrder', ['orderid' => $orderId, 'cancelsub' => $cancelSub]);
    }

    public function getOrders(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();

        $resolver->setDefined('userid')
            ->setAllowedTypes('userid', 'int');
        $resolver->setDefined('requestor_id')
            ->setAllowedTypes('requestor_id', 'int');

        return $this->send('GetOrders', $resolver->resolve($parameters));
    }

    public function getOrderStatuses()
    {
        return $this->send('GetOrderStatuses');
    }

    public function getProducts(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();

        $resolver->setDefined('pid')
            ->setAllowedTypes('pid', 'int');
        $resolver->setDefined('gid')
            ->setAllowedTypes('gid', 'int');

        return $this->send('GetProducts', $resolver->resolve($parameters));
    }

    public function getPromotions(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();

        $resolver->setDefined('code')
            ->setAllowedTypes('code', 'string');

        return $this->send('getPromotions', $resolver->resolve($parameters));
    }

    public function orderFraudCheck(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();

        $resolver->setDefined('orderid')
            ->setAllowedTypes('orderid', 'int');
        $resolver->setDefined('ip')
            ->setAllowedTypes('ip', 'string')
            ->setInfo('ip', 'Must be a valid ipv4/6')
            ->setAllowedValues('ip', function ($value): bool {
                return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6);
            });

        $resolver->setRequired('orderid');

        return $this->send('OrderFraudCheck', $resolver->resolve($parameters));
    }

    public function pendingOrder(int $orderId)
    {
        return $this->send('PendingOrder', ['orderid' => $orderId]);
    }
}
