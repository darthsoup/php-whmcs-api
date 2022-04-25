<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi;

use DarthSoup\WhmcsApi\Api\Addons;
use DarthSoup\WhmcsApi\Api\Affiliates;
use DarthSoup\WhmcsApi\Api\Authentication;
use DarthSoup\WhmcsApi\Api\Billing;
use DarthSoup\WhmcsApi\Api\Client;
use DarthSoup\WhmcsApi\Api\Custom;
use DarthSoup\WhmcsApi\Api\Domains;
use DarthSoup\WhmcsApi\Api\Orders;
use DarthSoup\WhmcsApi\Api\Products;
use DarthSoup\WhmcsApi\Api\Servers;
use DarthSoup\WhmcsApi\Api\Service;
use DarthSoup\WhmcsApi\Api\System;
use DarthSoup\WhmcsApi\Api\Users;

trait ApiClassTrait
{
    public function addons(): Addons
    {
        return new Addons($this);
    }

    public function affiliates(): Affiliates
    {
        return new Affiliates($this);
    }

    public function authentication(): Authentication
    {
        return new Authentication($this);
    }

    public function billing(): Billing
    {
        return new Billing($this);
    }

    public function client(): Client
    {
        return new Client($this);
    }

    public function domains(): Domains
    {
        return new Domains($this);
    }

    public function orders(): Orders
    {
        return new Orders($this);
    }

    public function products(): Products
    {
        return new Products($this);
    }

    public function servers(): Servers
    {
        return new Servers($this);
    }

    public function service(): Service
    {
        return new Service($this);
    }

    public function system(): System
    {
        return new System($this);
    }

    public function users(): Users
    {
        return new Users($this);
    }

    public function custom(): Custom
    {
        return new Custom($this);
    }
}
