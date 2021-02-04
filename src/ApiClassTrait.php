<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi;

use DarthSoup\WhmcsApi\Api\Client;

trait ApiClassTrait
{
    /**
     * @return Client
     */
    public function client(): Client
    {
        return new Client($this);
    }
}
