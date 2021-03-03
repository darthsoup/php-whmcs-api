<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class System extends AbstractApi
{
    public function whmcsDetails()
    {
        return $this->send('WhmcsDetails');
    }
}
