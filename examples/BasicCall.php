<?php
require_once '../vendor/autoload.php';

$client = new \DarthSoup\WhmcsApi\Client();

// Login Credentials with Username and Password (without md5)
$client->authenticate('admin', 'admin', 'apikey', \DarthSoup\WhmcsApi\Client::AUTH_LOGIN_CREDENTIALS);
$client->url('http://whmcs.local:8081');

var_dump($client->orders()->getOrders());
