<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Servers extends AbstractApi
{
    public function getHealthStatus(bool $fetchStatus = false)
    {
        return $this->send('GetHealthStatus', ['fetchStatus' => $fetchStatus]);
    }

    public function GetServers(bool $fetchStatus = false)
    {
        return $this->send('GetServers', ['fetchStatus' => $fetchStatus]);
    }
}
