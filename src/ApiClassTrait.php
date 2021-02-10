<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi;

use DarthSoup\WhmcsApi\Api\Client;
use DarthSoup\WhmcsApi\Api\Custom;

trait ApiClassTrait
{
    /**
     * @return Client
     */
    public function client(): Client
    {
        return new Client($this);
    }

    /**
     * @return Custom
     */
    public function custom(): Custom
    {
        return new Custom($this);
    }
}
