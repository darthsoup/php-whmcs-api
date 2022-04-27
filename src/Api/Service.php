<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Service extends AbstractApi
{
    public function moduleChangePackage(int $serviceId)
    {
        $this->send('ModuleChangePackage', ['serviceid' => $serviceId]);
    }

    public function moduleChangePw(int $serviceId, string $servicePassword)
    {
        $this->send('ModuleChangePw', [
            'serviceid' => $serviceId,
            'servicepassword' => $servicePassword
        ]);
    }

    public function moduleCreate(int $serviceId)
    {
        $this->send('ModuleCreate', ['serviceid' => $serviceId]);
    }

    public function moduleCustom(int $serviceId, string $funcName)
    {
        $this->send('ModuleCustom', [
            'serviceid' => $serviceId,
            'func_name' => $funcName
        ]);
    }

    public function moduleSuspend(int $serviceId, string $suspendReason)
    {
        $this->send('ModuleSuspend', [
            'serviceid' => $serviceId,
            'suspendreason' => $suspendReason
        ]);
    }

    public function moduleTerminate(int $serviceId)
    {
        $this->send('ModuleTerminate', ['serviceid' => $serviceId]);
    }

    public function moduleUnsuspend(int $serviceId)
    {
        $this->send('ModuleUnsuspend', ['serviceid' => $serviceId]);
    }

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
