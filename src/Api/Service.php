<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Service extends AbstractApi
{
    /**
     * @see https://developers.whmcs.com/api-reference/modulechangepackage/
     */
    public function moduleChangePackage(int $serviceId)
    {
        return $this->send('ModuleChangePackage', ['serviceid' => $serviceId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/modulechangepw/
     */
    public function moduleChangePw(int $serviceId, string $servicePassword)
    {
        return $this->send('ModuleChangePw', [
            'serviceid' => $serviceId,
            'servicepassword' => $servicePassword
        ]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/modulecreate/
     */
    public function moduleCreate(int $serviceId)
    {
        return $this->send('ModuleCreate', ['serviceid' => $serviceId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/modulecustom/
     */
    public function moduleCustom(int $serviceId, string $funcName)
    {
        return $this->send('ModuleCustom', [
            'serviceid' => $serviceId,
            'func_name' => $funcName
        ]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/modulesuspend/
     */
    public function moduleSuspend(int $serviceId, string $suspendReason)
    {
        return $this->send('ModuleSuspend', [
            'serviceid' => $serviceId,
            'suspendreason' => $suspendReason
        ]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/moduleterminate/
     */
    public function moduleTerminate(int $serviceId)
    {
        return $this->send('ModuleTerminate', ['serviceid' => $serviceId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/moduleunsuspend/
     */
    public function moduleUnsuspend(int $serviceId)
    {
        return $this->send('ModuleUnsuspend', ['serviceid' => $serviceId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/updateclientproduct/
     */
    public function updateClientProduct(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'serviceid', 'pid', 'serverid', 'regdate', 'nextduedate', 'terminationdate', 'domain', 'firstpaymentamount',
            'recurringamount', 'paymentmethod', 'billingcycle', 'subscriptionid', 'status', 'notes', 'serviceusername',
            'servicepassword', 'overideautosuspend', 'overidesuspenduntil', 'ns1', 'ns2', 'dedicatedip', 'assignedips',
            'diskusage', 'disklimit', 'bwusage', 'bwlimit', 'suspendreason', 'promoid', 'unset', 'autorecalc',
            'customfields', 'configoptions'
        ]);
        $resolver->setAllowedTypes('serviceid', 'int');
        $resolver->setRequired(['serviceid']);

        return $this->send('UpdateClientProduct', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/upgradeproduct/
     */
    public function upgradeProduct(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'serviceid', 'calconly', 'paymentmethod', 'type', 'newproductid', 'newproductbillingcycle',
            'promocode', 'configoptions'
        ]);
        $resolver->setAllowedTypes('serviceid', 'int');
        $resolver->setAllowedTypes('paymentmethod', 'string');
        $resolver->setAllowedTypes('type', 'string');
        $resolver->setRequired(['serviceid', 'paymentmethod', 'type']);

        return $this->send('UpgradeProduct', $resolver->resolve($parameters));
    }
}
