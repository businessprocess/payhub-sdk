Payhub PHP SDK
=============================
![PHP 8.x](https://img.shields.io/badge/PHP-%5E8.0-blue)
[![Laravel 8.x](https://img.shields.io/badge/Laravel-8.x-orange.svg)](http://laravel.com)
[![Yii 2.x](https://img.shields.io/badge/Yii-2.x-orange)](https://www.yiiframework.com/doc/guide/2.0/ru)
[![Latest Stable Version](https://poser.pugx.org/businessprocess/payhub-sdk/v/stable)](https://packagist.org/packages/businessprocess/payhub-sdk)
![Release date](https://img.shields.io/github/release-date/businessprocess/payhub-sdk)
![Release Version](https://img.shields.io/github/v/release/businessprocess/payhub-sdk)
![Total Downloads](https://poser.pugx.org/businessprocess/payhub-sdk/downloads)
![Pull requests](https://img.shields.io/bitbucket/pr/businessprocess/payhub-sdk)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
![Stars](https://img.shields.io/github/stars/businessprocess/notify-service?style=social)

Payhub SDK is a PSR-compatible PHP package for working with payhub api.

[API Documentation](https://payhub.ooo.ua/api/api-docs/)


## Installation
The recommended way to install Payhub SDK is through
[Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest stable version of Guzzle:

```bash
composer require businessprocess/payhub-sdk
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

You can then later update Guzzle using composer:

 ```bash
composer update
 ```

## Usage

```php
$client = new \Payhub\Service\Payhub([
    'url' => '', # Project url
    'key' => '', # Resource key
    'token' => '', # Api token
]);
$order = \Payhub\Models\Order::make([
    'type' => 1,
    'callback_url' => 'https://your-callback.url',
    ...
]);
$response = $client->create($order);

echo $response->all(); # '[{"link": ...}'
```

## Usage Laravel

```php
$order = \Payhub\Models\Order::make([
    'type' => 1,
    'callback_url' => 'https://your-callback.url',
    ...
]);
$response = \Payhub\Facade\Payhub::create($order);

echo $response->all(); # '[{"link": ...}'
```

#### Available Methods

| Methods           | Description                   | Return value        | 
|-------------------|-------------------------------|---------------------|
| create            | Create order                  | OrderCreateResponse |
| getList           | Get order list                | array               |
| getById           | Get order by id               | Order               |
| getPaymentMethods | Get available payment methods | array               |
