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
        $this->send(
            'UpdateClientProduct',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function upgradeProduct(array $parameters = [])
    {
        $this->send(
            'UpgradeProduct',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }
}
