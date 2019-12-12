# PayU MEA PHP bindings

[![Build Status](https://travis-ci.org/netcraft-devops/payu-sdk-php.svg?branch=master)](https://travis-ci.org/netcraft-devops/payu-sdk-php)
[![Latest Stable Version](https://poser.pugx.org/netcrat-devops/payu-sdk-php/v/stable)](https://packagist.org/packages/netcrat-devops/payu-sdk-php)
[![Total Downloads](https://poser.pugx.org/netcrat-devops/payu-sdk-php/downloads)](https://packagist.org/packages/netcrat-devops/payu-sdk-php)
[![License](https://poser.pugx.org/netcrat-devops/payu-sdk-php/license)](https://packagist.org/packages/netcrat-devops/payu-sdk-php)
[![Coverage Status](https://coveralls.io/repos/github/netcraft-devops/payu-sdk-php/badge.svg?branch=master)](https://coveralls.io/github/netcraft-devops/payu-sdk-php?branch=master)

__Welcome to PayU PHP SDK__. This repository contains PayU's PHP SDK and samples for both Enterprise and Redirect SOAP API.

## Please Note
> **The Payment Card Industry (PCI) Council has [mandated](http://blog.pcisecuritystandards.org/migrating-from-ssl-and-early-tls) that early versions of TLS be retired from service.  All organizations that handle credit card information are required to comply with this standard. As part of this obligation, PayU has updated its services to require TLS 1.2 for all HTTPS connections. At this time, PayU will also require HTTP/1.1 for all connections.**

You can sign up for a PayU account at https://payu.co.za.

## Requirements

PHP 5.4 and later.

## Composer

You can install the bindings via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require netcraft-devops/payu-sdk-php
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/00-intro.md#autoloading):

```php
require_once('vendor/autoload.php');
```

## Dependencies

The bindings require the following extension in order to work properly:

- [`soap`](https://php.net/manual/en/book.soap.php)
- [`openssl`](http://php.net/manual/en/book.openssl.php)
- [`json`](https://php.net/manual/en/book.json.php)
- [`mbstring`](http://php.net/manual/en/book.mbstring.php)

If you use Composer, these dependencies should be handled automatically. If you install manually, you'll want to make sure that these extensions are available.

## Documentation

## SDK Documentation

Everything from SDK Wiki, to Sample Codes, to Releases. Here are few quick links to get you there faster.

Please see  for up-to-date documentation.
* [ Samples ](https://github.com/netcraft-devops/payu-sdk-php/tree/master/samples)
* [ PayU Developer Docs] (http://help.payu.co.za/display/developers/)

## Development

Install dependencies:

``` bash
composer install
```

## Tests

Install dependencies as mentioned above (which will resolve [PHPUnit](http://packagist.org/packages/phpunit/phpunit)), then you can run the test suite:

```bash
./vendor/bin/phpunit
```

Or to run an individual test file:

```bash
./vendor/bin/phpunit tests/PayU/Test/Api/AmounTest.php
```