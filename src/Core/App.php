<?php

namespace Core;

use Core\Renderer\TwigRenderer;
use Core\Routing\Router;
use GuzzleHttp\Psr7\Response;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class App
 * The conductor of the application
 */
class App
{

    /**
     * @var Router
     */
    private $router;

    /**
     * @var Renderer
     */
    private $renderer;

    /**
     * @var array
     */
    private $bundles = [];

    /**
     * Application constructor.
     *
     * @param array $bundles
     */
    public function __construct(array $bundles = [])
    {
        $this->router = new Router();

        $this->renderer = new TwigRenderer(dirname(dirname(__DIR__)) . '/resources/views');

        foreach ($bundles as $bundle) {
            $this->bundles[] = new $bundle($this->router, $this->renderer);
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @return Response|mixed
     */
    public function run(ServerRequestInterface $request)
    {

        $uri = $request->getUri()->getPath();
        if ($uri[-1] === '/' && $uri !== '/') {
            return new Response(301, ['Location' => substr($uri, 0, -1)], null, 1.1);
        }

        $route = $this->router->match($request);

        if (is_null($route)) {
            return new Response(404, [], 'Not Found ;(');
        }

        foreach ($route->getRouteParams() as $key => $parameter) {
            $request = $request->withAttribute($key, $parameter);
        }

        $response = call_user_func_array($route->getRouteCallback(), [$request]);


        if ($response instanceof ResponseInterface) {
            return $response;
        } elseif (is_string($response)) {
            return new Response(200, [], $response, 1.1);
        }

        throw new \RuntimeException('This response does not correct. Normally the response must be an instance of ResponseInterface.');
    }
}
