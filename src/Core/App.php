<?php

namespace Core;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App
{

    public function run(ServerRequestInterface $request) : ResponseInterface
    {

        $uri = $request->getUri()->getPath();
        if ($uri[-1] === '/' && $uri !== '/') {
            return new Response(301, ['Location' => substr($uri, 0, -1)], null, 1.1);
        }
        if ($uri === '/') {
            return new Response(200, [], null);
        }
        return new Response(404, [], 'Not Found ;(');
    }

}
