<?php
require_once '../vendor/autoload.php';

$client = new \DarthSoup\WhmcsApi\Client();

// Login Credentials with Username and Password (without md5)
$client->authenticate('admin', 'secret', \DarthSoup\WhmcsApi\Client::AUTH_LOGIN_CREDENTIALS);
# $client->accessKey('apikey'); # if needed
$client->url('http://whmcs.local:8081');

try {
    $result = $client->client()->addClient([
        'firstname' => 'Testname',
        'lastname' => 'TestLastname',
        'email' => 'foo@bar.com',
        'address1' => 'Street 1234',
        'city' => 'Berlin',
        'postcode' => '12345',
        'country' => 'DE',
        'state' => 'Berlin',
        'password2' => 'Abc1234$',
        'phonenumber' => '+49.1512 3456789',
        'clientip' => '192.168.0.1',
    ]);

    var_dump($result);
} catch (\Exception $exception) {
    var_dump($exception);
    die();
}

