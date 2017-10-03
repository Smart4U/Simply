<?php

namespace Core;

use Core\Renderer\TwigRenderer;
use Core\Routing\Router;
use GuzzleHttp\Psr7\Response;

use Psr\Container\ContainerInterface;
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
     * @var ContainerInterface
     */
    private $container;


    /**
     * App constructor.
     * @param ContainerInterface $container
     * @param array $bundles
     */
    public function __construct(ContainerInterface $container, array $bundles = [])
    {
        $this->container = $container;
        foreach ($bundles as $bundle) {
            $this->bundles[] = $container->get($bundle);
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

        $route = $this->container->get(Router::class)->match($request);

        if (is_null($route)) {
            return new Response(404, [], 'Not Found ;(');
        }

        $params = $route->getRouteParams();

        $request = array_reduce(array_keys($params), function ($request, $key) use ($params) {
            return $request->withAttribute($key, $params[$key]);
        }, $request);

        $callback = $route->getRouteCallback();
        if (is_string($callback)) {
            $callback = $this->container->get($callback);
        }
        $response = call_user_func_array($callback, [$request]);

        if ($response instanceof ResponseInterface) {
            return $response;
        } elseif (is_string($response)) {
            return new Response(200, [], $response, 1.1);
        }

        throw new \RuntimeException('This response does not correct. Normally the response must be an instance of ResponseInterface.');
    }
}
