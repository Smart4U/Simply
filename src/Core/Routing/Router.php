<?php

namespace Core\Routing;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Router\Route as ZendRoute;

/**
 * Class Router
 * Management of application routes
 */
class Router
{

    /**
     * @var FastRouteRouter
     */
    private $router;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->router = new FastRouteRouter();
    }

    /**
     * @param string $path
     * @param callable|string $callback
     * @param string|null $name
     */
    public function get(string $path, $callback, ?string $name = null) :void
    {
        $this->router->addRoute(new ZendRoute($path, $callback, ['GET'], $name));
    }

    public function post(string $path, $callback, ?string $name = null) :void
    {
        $this->router->addRoute(new ZendRoute($path, $callback, ['POST'], $name));
    }


    public function put(string $path, $callback, ?string $name = null) :void
    {
        $this->router->addRoute(new ZendRoute($path, $callback, ['PUT'], $name));
    }

    public function delete(string $path, $callback, ?string $name = null) :void
    {
        $this->router->addRoute(new ZendRoute($path, $callback, ['DELETE'], $name));
    }

    public function crud(string $prefixPath, $callback, string $prefixName)
    {
        $this->get("$prefixPath", $callback, $prefixName . '.index');
        $this->get("$prefixPath/add", $callback, $prefixName . '.create');
        $this->post("$prefixPath/add", $callback, $prefixName . '.store');
        $this->get("$prefixPath/{id:\d+}", $callback, $prefixName . '.edit');
        $this->post("$prefixPath/{id:\d+}", $callback, $prefixName . '.update');
        $this->delete("$prefixPath/{id:\d+}", $callback, $prefixName . '.delete');
    }

    /**
     * Check if route is valid
     *
     * @param ServerRequestInterface $request
     * @return Route|null
     */
    public function match(ServerRequestInterface $request): ?Route
    {
        $result = $this->router->match($request);
        if ($result->isSuccess()) {
            return new Route($result->getMatchedRouteName(), $result->getMatchedMiddleware(), $result->getMatchedParams());
        }
        return null;
    }

    /**
     * @param string $name
     * @param array $params
     * @return null|string
     */
    public function generateUri(string $name, array $params = [], array $queryParams = []): ?string
    {
        $uri = $this->router->generateUri($name, $params);
        if (!empty($queryParams)) {
            return $uri . '?' . http_build_query($queryParams);
        }
        return $uri;
    }
}
