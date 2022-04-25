<?php
require_once '../vendor/autoload.php';

$client = new \DarthSoup\WhmcsApi\Client();

// Login Credentials with Username and Password (without md5)
$client->authenticate('admin', 'secret', \DarthSoup\WhmcsApi\Client::AUTH_LOGIN_CREDENTIALS);
# $client->accessKey('apikey'); # if needed
$client->url('http://whmcs.local:8081');

var_dump($client->orders()->getOrders());
