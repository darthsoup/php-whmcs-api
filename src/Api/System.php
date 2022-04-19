<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class System extends AbstractApi
{

    public function decryptPassword(string $password)
    {
        return $this->send('DecryptPassword', ['password2' => $password]);
    }

    public function encryptPassword(string $password)
    {
        return $this->send('EncryptPassword', ['password2' => $password]);
    }

    public function getStats(int $timelineDays)
    {
        return $this->send('GetStats', ['timeline_days' => $timelineDays]);
    }

    public function whmcsDetails()
    {
        return $this->send('WhmcsDetails');
    }
}
