# PHP WHMCS API Client

A simple, PSR-7 compatible WHMCS API client for PHP, inspired by [GitLabPHP/Client](https://github.com/GitLabPHP/Client).

[![Tests](https://github.com/darthsoup/php-whmcs-api/actions/workflows/test.yml/badge.svg)](https://github.com/darthsoup/php-whmcs-api/actions/workflows/test.yml)
[![License](https://img.shields.io/github/license/darthsoup/php-whmcs-api)](https://github.com/darthsoup/php-whmcs-api/blob/master/LICENSE.md)

## Requirements

- PHP **^7.4 | ^8.0 | ^8.1 | ^8.2 | ^8.3 | ^8.4**
- PHP extensions: `curl`, `json`, `mbstring`

## Installation

```bash
composer require darthsoup/php-whmcs-api guzzlehttp/guzzle:"^7.8" http-interop/http-factory-guzzle:"^1.0"
```

## Usage

### Initialize the client

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

$client = new \DarthSoup\WhmcsApi\Client();

// Authenticate with API identifier and secret
$client->authenticate('your_identifier', 'your_secret', \DarthSoup\WhmcsApi\Client::AUTH_API_CREDENTIALS);

// Or authenticate with login credentials (username and password, plain text)
$client->authenticate('your_username', 'your_password', \DarthSoup\WhmcsApi\Client::AUTH_LOGIN_CREDENTIALS);

// Set the URL to your WHMCS instance
$client->url('https://<your_whmcs_instance_url>');
```

### API access key

If your WHMCS instance has an [`$api_access_key`](https://docs.whmcs.com/API_Authentication_Tokens#Access_Key) set in `configuration.php`, pass it via `accessKey()` during client setup:

```php
$client = new \DarthSoup\WhmcsApi\Client();
$client->authenticate('your_identifier', 'your_secret', \DarthSoup\WhmcsApi\Client::AUTH_API_CREDENTIALS);
$client->accessKey('your_access_key');
$client->url('https://<your_whmcs_instance_url>');
```

The access key is automatically appended to every API request body.

## Endpoints

| Name           | Status     |
|----------------|------------|
| Addons         | Complete   |
| Affiliates     | Complete   |
| Authentication | Complete   |
| Billing        | Complete   |
| Client         | Complete   |
| Domains        | Complete   |
| Orders         | Complete   |
| Products       | Complete   |
| Servers        | Complete   |
| Service        | Complete   |
| Support        | Incomplete |
| System         | Complete   |
| Ticket         | Incomplete |
| Users          | Complete   |

## Examples

### Get clients

```php
$client->client()->getClients(['search' => 'firstname']);
```

### Get all orders

```php
$client->orders()->getOrders();
```

### Call a custom API route

If your WHMCS instance exposes custom API routes, you can call them directly without extending the library:

```php
$parameters = ['foo' => 'bar'];
$client->custom()->yourCustomApiName($parameters);
```

More examples can be found in the [`/examples`](examples/) directory.

## Disclaimer

This client follows the [WHMCS API documentation](https://developers.whmcs.com/api/api-index/). Note that parts of the official API documentation are incomplete or inconsistently documented — please verify behaviour against your WHMCS version.

## Support

[Open an issue on GitHub](https://github.com/darthsoup/php-whmcs-api/issues)

## License

This package is released under the MIT License. See the bundled [LICENSE](https://github.com/darthsoup/php-whmcs-api/blob/master/LICENSE.md) file for details.
