# GuzzleGet Example of HTTP Message Strategies PSR (pre-Draft) [![Build Status](https://travis-ci.org/http-message-strategies-interop/example-guzzle-get.svg?branch=master)](https://travis-ci.org/http-message-strategies-interop/example-guzzle-get) [![Coverage Status](https://coveralls.io/repos/github/http-message-strategies-interop/example-guzzle-get/badge.svg?branch=master)](https://coveralls.io/github/http-message-strategies-interop/example-guzzle-get?branch=master)

## Install

```
$ composer require http-message-strategies-interop/example-guzzle-get
```

## Usage

```php
use Interop\Http\Message\Strategies\Examples\GuzzleGet\GuzzleGet;
use GuzzleHttp\Psr7\Request;

$gget = new GuzzleGet();

$response0 = $gget(new Request('GET', 'http://httpbin.org'));
$response1 = $gget(new Request('GET', 'http://httpbin.org/get'));
```

## Related

* [HTTP Message Strategies PSR (pre-Draft)](https://github.com/http-message-strategies-interop/fig-standards/tree/http-message-strategies/proposed/http-message-strategies)

## License

MIT © [Michael Mayer](http://schnittstabil.de)
