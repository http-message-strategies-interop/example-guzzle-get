<?php

namespace Interop\Http\Message\Strategies\Examples\GuzzleGet;

use Interop\Http\Message\Strategies\ActionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class GuzzleGet implements ActionInterface
{
    /** @var array Default request options */
    private $config;

    /**
     * @param array $config \GuzzleHttp\Client configuration settings
     *
     * @see \GuzzleHttp\Client for details
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }
    /**
     * Send a request and return the response.
     *
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $request)
    {
        try {
            return (new \GuzzleHttp\Client($this->config))->send($request);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $e->getResponse();
            }

            throw $e;
        }
    }
}
