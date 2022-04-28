<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Servers extends AbstractApi
{
    /**
     * @see https://developers.whmcs.com/api-reference/gethealthstatus/
     */
    public function getHealthStatus(bool $fetchStatus = false)
    {
        return $this->send('GetHealthStatus', ['fetchStatus' => $fetchStatus]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getservers/
     */
    public function getServers(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['serviceId', 'addonId', 'fetchStatus']);
        $resolver->setAllowedTypes('serviceId', 'int');
        $resolver->setAllowedTypes('addonId', 'int');
        $resolver->setAllowedTypes('fetchStatus', 'bool');

        return $this->send('GetServers', $resolver->resolve($parameters));
    }
}
