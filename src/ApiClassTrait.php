<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi;

use DarthSoup\WhmcsApi\Api\Authentication;
use DarthSoup\WhmcsApi\Api\Billing;
use DarthSoup\WhmcsApi\Api\Custom;
use DarthSoup\WhmcsApi\Api\Domains;
use DarthSoup\WhmcsApi\Api\Orders;
use DarthSoup\WhmcsApi\Api\Servers;
use DarthSoup\WhmcsApi\Api\System;
use DarthSoup\WhmcsApi\Api\Users;

trait ApiClassTrait
{
    /**
     * @return Authentication
     */
    public function authentication(): Authentication
    {
        return new Authentication($this);
    }

    /**
     * @return Billing
     */
    public function billing(): Billing
    {
        return new Billing($this);
    }

    /**
     * @return Client
     */
    public function client(): Client
    {
        return new Client($this);
    }

    /**
     * @return Domains
     */
    public function domains(): Domains
    {
        return new Domains($this);
    }

    /**
     * @return Orders
     */
    public function orders(): Orders
    {
        return new Orders($this);
    }

    /**
     * @return Servers
     */
    public function servers(): Servers
    {
        return new Servers($this);
    }

    /**
     * @return System
     */
    public function system(): System
    {
        return new System($this);
    }

    /**
     * @return Users
     */
    public function users(): Users
    {
        return new Users($this);
    }

    /**
     * @return Custom
     */
    public function custom(): Custom
    {
        return new Custom($this);
    }
}
