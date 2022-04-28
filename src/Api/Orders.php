<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Orders extends AbstractApi
{
    /**
     * @see https://developers.whmcs.com/api-reference/acceptorder/
     */
    public function acceptOrder(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'orderid', 'serverid', 'serviceusername', 'servicepassword', 'registrar',
            'sendregistrar', 'autosetup', 'sendemail',
        ]);
        $resolver->setAllowedTypes('orderid', 'int');
        $resolver->setAllowedTypes('serverid', 'int');
        $resolver->setAllowedTypes('serviceusername', 'string');
        $resolver->setAllowedTypes('servicepassword', 'string');
        $resolver->setAllowedTypes('registrar', 'string');
        $resolver->setAllowedTypes('sendregistrar', 'bool');
        $resolver->setAllowedTypes('autosetup', 'bool');
        $resolver->setAllowedTypes('sendemail', 'bool');

        $resolver->setRequired('orderid');

        return $this->send('AcceptOrder', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/addorder/
     */
    public function addOrder(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'clientid', 'paymentmethod', 'pid', 'billingcycle', 'domaintype', 'regperiod', 'idnlanguage', 'eppcode',
            'nameserver1', 'nameserver2', 'nameserver3', 'nameserver4', 'nameserver5', 'customfields', 'configoptions',
            'priceoverride', 'promocode', 'promooverride', 'affid', 'noinvoice', 'noinvoiceemail', 'noemail', 'addons',
            'hostname', 'ns1prefix', 'ns2prefix', 'rootpw', 'contactid', 'dnsmanagement', 'domainfields',
            'emailforwarding', 'idprotection', 'domainpriceoverride', 'domainrenewoverride', 'domainrenewals',
            'addonid', 'serviceid', 'addonids', 'serviceids',
        ]);
        $resolver->setAllowedTypes('clientid', 'int');
        $resolver->setAllowedTypes('paymentmethod', 'string');
        $resolver->setAllowedTypes('pid', 'int[]');
        $resolver->setAllowedTypes('billingcycle', 'string[]');
        $resolver->setAllowedTypes('domaintype', 'string[]');
        $resolver->setAllowedTypes('regperiod', 'int[]');
        $resolver->setAllowedTypes('idnlanguage', 'string[]');
        $resolver->setAllowedTypes('eppcode', 'string[]');
        $resolver->setAllowedTypes('nameserver1', 'string');
        $resolver->setAllowedTypes('nameserver2', 'string');
        $resolver->setAllowedTypes('nameserver3', 'string');
        $resolver->setAllowedTypes('nameserver4', 'string');
        $resolver->setAllowedTypes('nameserver5', 'string');
        $resolver->setAllowedTypes('customfields', 'string[]');
        $resolver->setAllowedTypes('configoptions', 'string[]');
        $resolver->setAllowedTypes('priceoverride', 'float[]');
        $resolver->setAllowedTypes('promocode', 'string');
        $resolver->setAllowedTypes('promooverride', 'bool');
        $resolver->setAllowedTypes('affid', 'int');
        $resolver->setAllowedTypes('noinvoice', 'bool');
        $resolver->setAllowedTypes('noinvoiceemail', 'bool');
        $resolver->setAllowedTypes('noemail', 'bool');
        $resolver->setAllowedTypes('addons', 'string[]');
        $resolver->setAllowedTypes('hostname', 'string[]');
        $resolver->setAllowedTypes('ns1prefix', 'string[]');
        $resolver->setAllowedTypes('ns2prefix', 'string[]');
        $resolver->setAllowedTypes('rootpw', 'string[]');
        $resolver->setAllowedTypes('contactid', 'int');
        $resolver->setAllowedTypes('dnsmanagement', 'bool[]');
        $resolver->setAllowedTypes('domainfields', 'string[]');
        $resolver->setAllowedTypes('emailforwarding', 'bool[]');
        $resolver->setAllowedTypes('idprotection', 'bool[]');
        $resolver->setAllowedTypes('domainpriceoverride', 'float[]');
        $resolver->setAllowedTypes('domainrenewoverride', 'float[]');
        $resolver->setAllowedTypes('domainrenewals', 'array');
        $resolver->setAllowedTypes('addonid', 'int');
        $resolver->setAllowedTypes('serviceid', 'int');
        $resolver->setAllowedTypes('addonids', 'int[]');
        $resolver->setAllowedTypes('serviceids', 'int[]');
        $resolver->setRequired(['clientId', 'paymentmethod']);

        return $this->send('AddOrder', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/cancelorder/
     */
    public function cancelOrder(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['orderid', 'cancelsub', 'noemail']);
        $resolver->setAllowedTypes('orderid', 'int');
        $resolver->setAllowedTypes('cancelsub', 'bool');
        $resolver->setAllowedTypes('noemail', 'bool');
        $resolver->setRequired(['orderid']);

        return $this->send('CancelOrder', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/deleteorder/
     */
    public function deleteOrder(int $orderId)
    {
        return $this->send('DeleteOrder', ['orderid' => $orderId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/fraudorder/
     */
    public function fraudOrder(int $orderId, bool $cancelSub = false)
    {
        return $this->send('FraudOrder', ['orderid' => $orderId, 'cancelsub' => $cancelSub]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getorders/
     */
    public function getOrders(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['userid', 'requestor_id']);
        $resolver->setAllowedTypes('userid', 'int');
        $resolver->setAllowedTypes('requestor_id', 'int');

        return $this->send('GetOrders', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getorderstatuses/
     */
    public function getOrderStatuses()
    {
        return $this->send('GetOrderStatuses');
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getproducts/
     */
    public function getProducts(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['pid', 'gpid', 'module']);
        $resolver->setAllowedTypes('pid', 'int');
        $resolver->setAllowedTypes('gid', 'int');
        $resolver->setAllowedTypes('module', 'string');

        return $this->send('GetProducts', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getpromotions/
     */
    public function getPromotions(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['code']);
        $resolver->setAllowedTypes('code', 'string');

        return $this->send('getPromotions', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/orderfraudcheck/
     */
    public function orderFraudCheck(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();

        $resolver->setDefined(['orderid']);
        $resolver->setAllowedTypes('orderid', 'int');
        $resolver->setRequired('orderid');

        return $this->send('OrderFraudCheck', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/pendingorder/
     */
    public function pendingOrder(int $orderId)
    {
        return $this->send('PendingOrder', ['orderid' => $orderId]);
    }
}
