# PHP WHMCS API Client

Simple and PSR7 compatible WHMCS API Client which is inspired by [m4tthumphrey/php-gitlab-api](https://packagist.org/packages/m4tthumphrey/php-gitlab-api).

[![Build Status][ico-github-actions-build]][link-github-actions-build]
[![Software License][ico-license]][link-license]

## Installation

### Composer

```bash
$ composer require "darthsoup/php-whmcs-api" "guzzlehttp/guzzle:^7.2" "http-interop/http-factory-guzzle:^1.0"
```

### System Requirements

This package requires:
- **PHP >= 7.4**
- `curl` and `json` php extensions

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
$client->url('http://<your_whmcs_instance_url>');
```

### Get clients

```php
$client->client()->getClients(['search' => 'firstname']);
```

### Get all orders

```php
$client->orders()->getOrders();
```

### Call custom API Route

If your WHMCS instance contains Custom API routes, you can also call them without editing the code.

```php
$parameters = ['foo' => 'bar'];
$client->custom()->yourCustomApiName($parameters);
```

## Disclaimer

If you use this client, please continue to check the documentation of the [WHMCS Developer](https://developers.whmcs.com/api/api-index/) Page. 
The documentation is very incomplete in some places functions are relatively error-prone.

## Support

[Please open an issue in github](https://github.com/darthsoup/php-whmcs-api/issues)

## License

This package is released under the MIT License. See the bundled
[LICENSE](https://github.com/darthsoup/php-whmcs-api/blob/master/LICENSE.md) file for details.
