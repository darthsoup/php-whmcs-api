# PHP WHMCS API Client

Simple and PSR7 compatible WHMCS API Client which is inspired by [GitLabPHP/Client](https://github.com/GitLabPHP/Client).

[![Unittests](https://github.com/darthsoup/php-whmcs-api/actions/workflows/phpunit.yml/badge.svg)](https://github.com/darthsoup/php-whmcs-api/actions/workflows/phpunit.yml)
[![GitHub license](https://img.shields.io/github/license/darthsoup/php-whmcs-api)](https://github.com/darthsoup/php-whmcs-api/blob/master/LICENSE.md)

## Installation

### Composer

```bash
$ composer require "darthsoup/php-whmcs-api" "guzzlehttp/guzzle:^7.4" "http-interop/http-factory-guzzle:^1.2"
```

### System Requirements

This package requires:
- **PHP ^7.4 | ^8.0**
- PHP extensions `curl`, `json` and `mbstring` 

## Usage

### Initialize Client 

Basic initialisation of the Client.

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

$client = new \DarthSoup\WhmcsApi\Client();

// Auth Credentials with identifier and secret
$client->authenticate('your_identifier', 'your_secret', \DarthSoup\WhmcsApi\Client::AUTH_API_CREDENTIALS);

// Login Credentials with Username and Password (without md5)
$client->authenticate('your_username', 'your_password', \DarthSoup\WhmcsApi\Client::AUTH_LOGIN_CREDENTIALS);

// Set the URL to your whmcs instance
$client->url('http://<your_whmcs_instance_url>');
```

### API access key

In case your instance has an additional `$api_access_key` configured in your whmcs `configuration.php`,
you can also add it by using `accessKey` in the init process.

```php
$client->accessKey('my_access_key');
```

## Examples

### Get clients

```php
$client->client()->getClients(['search' => 'firstname']);
```

### Get all orders

```php
$client->orders()->getOrders();
```

### Call custom API Route

If your WHMCS instance contains custom API routes, you can also call them without extending the code.

```php
$parameters = ['foo' => 'bar'];
$client->custom()->yourCustomApiName($parameters);
```

## Disclaimer

If you are using this client, please refer to the documentation on the [WHMCS Developer](https://developers.whmcs.com/api/api-index/) page.
The documentation of the API is very incomplete in some places and in some cases questionably documented.

## Support

[Please open an issue in github](https://github.com/darthsoup/php-whmcs-api/issues)

## License

This package is released under the MIT License. See the bundled
[LICENSE](https://github.com/darthsoup/php-whmcs-api/blob/master/LICENSE.md) file for details.
