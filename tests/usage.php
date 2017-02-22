#!/usr/bin/env php
<?php

require_once __DIR__.'/../vendor/autoload.php';

use Interop\Http\Message\Strategies\Examples\GuzzleGet\GuzzleGet;
use GuzzleHttp\Psr7\Request;

$gget = new GuzzleGet();

$response0 = $gget(new Request('GET', 'http://httpbin.org'));
$response1 = $gget(new Request('GET', 'http://httpbin.org/get'));

exit($response0->getStatusCode() === 200 && $response1->getStatusCode() === 200 ? 0 : 1);
