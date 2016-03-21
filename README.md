# PHP Client for 1001 Pharmacies API

A simple Object Oriented wrapper for 1001 pharmacies Restfull API, written with PHP5.

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/07f2ad65-9e54-4b56-9d6b-e4ad2ebb439b/mini.png)](https://insight.sensiolabs.com/projects/07f2ad65-9e54-4b56-9d6b-e4ad2ebb439b)

Uses [1001 Pharmacies API v1.0](https://api.1001pharmacies.com/).

## Requirements

* PHP >= 5.3.2 with [cURL](http://php.net/manual/en/book.curl.php) extension,
* [Guzzle](https://github.com/guzzle/guzzle) library,
* (optional) PHPUnit to run tests.

## Autoload

The new version of `meup-api-php-client` using [Composer](http://getcomposer.org).
The first step to use `meup-api-php-client` is to download composer:

```bash
$ curl -s http://getcomposer.org/installer | php
```

Then we have to install our dependencies using:
```bash
$ php composer.phar install
```
Now we can use autoloader from Composer by:

```json
{
    "require": {
        "1001pharmacies/meup-api-php-client": "@dev-master"
    }
}
```

> `meup-api-php-client` follows the PSR-0 convention names for its classes, which means you can easily integrate `meup-api-php-client` classes loading in your own autoloader.

## Basic usage of `meup-api-php-client` client with detailed data

```php
<?php

// This file is generated by Composer
require_once 'vendor/autoload.php';

$publicKey = '{my client id}';
$secretKey = '{my secret key}';

try {
    $client = new \Meup\Api\Client\MeupApiClient($publicKey, $secretKey, $apiVersion);

    $order  = $client
        ->api('order')
        ->find('1234567890')
    ;
} catch (\Exception $e) {
    // error logging ?
}
```

## Basic usage of `meup-api-php-client` client with paginated data

```php
<?php

// This file is generated by Composer
require_once 'vendor/autoload.php';

$publicKey = '{my client id}';
$secretKey = '{my secret key}';

try {
    $client = new \Meup\Api\Client\MeupApiClient($publicKey, $secretKey, $apiVersion);
    $pager  = new \Meup\Api\Client\ResultPager($client);
    $orderApiClient = $client->api(\Meup\Api\Client\Api::ORDERS);

    // Lazy fetcher
    $ordersPage1 = $pager->fetch($orderApiClient, 'all');
    if (true === $pager->hasNext()) {
        $ordersPage2 = $pager->fetchNext();
    }

    // Eager fetcher (Very slow !!! prefer lazy fetcher)
    $orders = $pager->fetchAll($orderApiClient, 'all');
    
    // Parameters
    $orderApiClient->setPerPage('5');
    $orders = $pager->fetch($orderApiClient, 'all');
    
    OR
    
    $orders = $pager->fetch($orderApiClient, 'all', array('perPage' => 5, 'page' => 2);
    
} catch (\Exception $e) {
    // error logging ?
}
```

'WARNING' : using 'all' like methods on routes with a lot a data may occur slow responses or timeout, prefer lazy fetch instead.

On paginated data you can navigate with methods :

| Methods           | Description                                       |
| :---------------- | :------------------------------------------------ |
| fetch()           | Fetch current data                                |
| fetchAll()        | Fetch all paginated data (Caution with big data)  |
| fetchFirst()      | Fetch first page                                  |
| fetchLast()       | Fetch last page                                   |
| fetchPrevious()   | Fetch previous page                               |
| hasPrevious()     | Check if pager has previous page                  |
| hasNext()         | Check if pager has next page                      |


## Cache usage

```php
<?php

// This file is generated by Composer
require_once 'vendor/autoload.php';

$publicKey = '{my client id}';
$secretKey = '{my secret key}';

try {
    $client = new \Meup\Api\Client\HttpClient\CachedHttpClient($publicKey, $secretKey, $apiVersion);
    $client->setCache(
        // Built in one, or any cache implementing this interface:
        // \Meup\Api\Client\HttpClient\Cache\CacheInterface
        new \Meup\Api\Client\HttpClient\Cache\FilesystemCache('/tmp/meup-api-php-client-cache')
    );

    $order  = $client->api('order')->find('1234567890');
} catch (\Exception $e) {
    // error logging ?
}
```

Using cache, the client will get cached responses if resources haven't changed since last time.

## Exceptions

Specifics exceptions are available in 1001Pharmacies PHP API Client (ex: `ApiNotRespondingException` / `AuthenticationException` ...) so surround yours api calls with try/catch blocks.

You could find Exceptions classes in `\Meup\Api\Client\Exception` namespace

## Documentation

See the [`doc` directory](doc/) for more detailed documentation.

## License

`meup-api-php-client` is licensed under the MIT License - see the LICENSE file for details
