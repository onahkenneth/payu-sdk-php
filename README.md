# PayU EMEA PHP bindings

[![Build Status](https://travis-ci.org/netcraft-devops/payu-sdk-php.svg?branch=master)](https://travis-ci.org/netcraft-devops/payu-sdk-php)
[![Latest Stable Version](https://poser.pugx.org/netcrat-devops/payu-sdk-php/v/stable)](https://packagist.org/packages/netcrat-devops/payu-sdk-php)
[![Total Downloads](https://poser.pugx.org/netcrat-devops/payu-sdk-php/downloads)](https://packagist.org/packages/netcrat-devops/payu-sdk-php)
[![License](https://poser.pugx.org/netcrat-devops/payu-sdk-php/license)](https://packagist.org/packages/netcrat-devops/payu-sdk-php)
[![Coverage Status](https://coveralls.io/repos/github/netcraft-devops/payu-sdk-php/badge.svg?branch=master)](https://coveralls.io/github/netcraft-devops/payu-sdk-php?branch=master)

You can sign up for a PayU account at https://payu.co.za.

## Requirements

PHP 5.3.3 and later.

## Composer

You can install the bindings via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require netcraft-devops/payu-sdk-php
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/00-intro.md#autoloading):

```php
require_once('vendor/autoload.php');
```

## Manual Installation

If you do not wish to use Composer, you can download the [latest release](https://github.com//payu-sdk-php/releases). Then, to use the bindings, include the `init.php` file.

```php
require_once('/path/to/payu-sdk-php/init.php');
```

## Dependencies

The bindings require the following extension in order to work properly:

- [`soap`](https://secure.php.net/manual/en/book.soap.php)
- [`curl`](https://secure.php.net/manual/en/book.curl.php)
- [`json`](https://secure.php.net/manual/en/book.json.php)
- [`mbstring`](https://secure.php.net/manual/en/book.mbstring.php) (Multibyte String)

If you use Composer, these dependencies should be handled automatically. If you install manually, you'll want to make sure that these extensions are available.

## Getting Started

Simple usage looks like:

```php
\PayU\PayU::setApiKey('d8e8fca2dc0f896fd7cb4cb0031ba249');
$myCard = array('number' => '4242424242424242', 'exp_month' => 8, 'exp_year' => 2018);
$charge = \PayU\Charge::create(array('card' => $myCard, 'amount' => 2000, 'currency' => 'usd'));
echo $charge;
```

## Documentation

Please see http://help.payu.co.za/ for up-to-date documentation.

## Custom cURL Options (e.g. proxies)

Need to set a proxy for your requests? Pass in the requisite `CURLOPT_*` array to the CurlClient constructor, using the same syntax as `curl_setopt_array()`. This will set the default cURL options for each HTTP request made by the SDK, though many more common options will be overridden by the client even if set here.

```php
// set up your tweaked Curl client
$curl = new \PayU\HttpClient\CurlClient(array(CURLOPT_PROXY => 'proxy.local:80'));
// tell PayU to use the tweaked client
\PayU\ApiRequestor::setHttpClient($curl);
```

Alternately, a callable can be passed to the CurlClient constructor that returns the above array based on request inputs. See `testDefaultOptions()` in `tests/CurlClientTest.php` for an example of this behavior. Note that the callable is called at the beginning of every API request, before the request is sent.

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
./vendor/bin/phpunit tests/UtilTest.php
```

## Attention plugin developers

Are you writing a plugin that integrates PayU and embeds our library? Then please use the `setAppInfo` function to identify your plugin. For example:

```php
\PayU\PayU::setAppInfo("MyAwesomePlugin", "1.1.2", "https://myawesomeplugin.info");
```

The method should be called once, before any request is sent to the API. The second and third parameters are optional.

### SSL / TLS configuration option

See the "SSL / TLS compatibility issues" paragraph above for full context. If you want to ensure that your plugin can be used on all systems, you should add a configuration option to let your users choose between different values for `CURLOPT_SSLVERSION`: none (default), `CURL_SSLVERSION_TLSv1` and `CURL_SSLVERSION_TLSv1_2`.