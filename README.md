# php-whmcs-api

[![Latest Stable Version](https://poser.pugx.org/darthsoup/php-whmcs-api/v)](//packagist.org/packages/darthsoup/php-whmcs-api)
![phpunit](https://github.com/darthsoup/php-whmcs-api/workflows/phpunit/badge.svg)
[![License](https://poser.pugx.org/darthsoup/php-whmcs-api/license)](//packagist.org/packages/darthsoup/php-whmcs-api)

## Installation

Install the package through [Composer](http://getcomposer.org/).

Run the Composer require command from the Terminal:

```bash
composer require "darthsoup/php-whmcs-api"
```

## Usage

### Initialize Client 

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

$identifer = "identifer_string";
$secret = "secret_string";

$client = new \DarthSoup\WhmcsApi\Client();
$client->authenticate($identifer, $secret, \DarthSoup\WhmcsApi\Client::AUTH_API_CREDENTIALS);
$client->url('http://<your_whmcs_instance_url>/includes/api.php');

# get me all of my clients
$client->client()->getClients();
```

### Call custom API Route
```php
$parameters = ['foo' => 'bar'];
$client->custom()->yourCustomApi($parameters);
```

## Support

[Please open an issue in github](https://github.com/darthsoup/php-whmcs-api/issues)

## License

This package is released under the MIT License. See the bundled
[LICENSE](https://github.com/darthsoup/php-whmcs-api/blob/master/LICENSE.md) file for details.
