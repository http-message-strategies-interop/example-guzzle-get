<?php

namespace Interop\Http\Message\Strategies\Examples\GuzzleGet;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use Interop\Http\Message\Strategies\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\ServerRequest;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class GuzzleGetTest extends \PHPUnit\Framework\TestCase
{
    public function testGuzzleGetShouldImplementsRequestHandlerInterface()
    {
        $this->assertInstanceOf(RequestHandlerInterface::class, new GuzzleGet());
    }

    public function testGuzzleGetShouldGet()
    {
        $gget = new GuzzleGet();
        $response = $gget(new Request('GET', 'http://httpbin.org'));
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGuzzleGetShouldGetServerRequest()
    {
        $gget = new GuzzleGet();
        $response = $gget(new ServerRequest([], [], 'http://httpbin.org', 'GET'));
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGuzzleGetShouldCatch404()
    {
        $mock = new MockHandler([new Response(404)]);
        $handler = HandlerStack::create($mock);
        $gget = new GuzzleGet(['handler' => $handler]);

        $response = $gget(new Request('GET', 'http://example.com'));
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testGuzzleGetShouldThrowConnectExceptions()
    {
        $this->expectException(ConnectException::class);

        $request = new Request('GET', 'http://example.com');
        $connectException = new ConnectException('foo', $request, new \Exception());

        $mock = new MockHandler([$connectException]);
        $handler = HandlerStack::create($mock);
        $gget = new GuzzleGet(['handler' => $handler]);

        $response = $gget($request);
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals(404, $response->getStatusCode());
    }
}
