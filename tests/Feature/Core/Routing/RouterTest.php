<?php

namespace Feature\Routing;

use Core\Routing\Router;
use GuzzleHttp\Psr7\ServerRequest;

use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

    private $router;

    public function setUp(){
        $this->router = new Router();
    }

    public function testValidGetRequest() {
        $request = new ServerRequest('GET', '/', [], null, 1.1);
        $this->router->get('/', function() {
            return '<h1>Homepage</h1>';
        }, 'homepage');
        $route = $this->router->match($request);
        $this->assertEquals('homepage', $route->getRouteName());
        $this->assertEquals('<h1>Homepage</h1>', call_user_func_array($route->getRouteCallback(), [$request]));
    }

    public function testInvalidGetRequest() {
        $request = new ServerRequest('GET', '/not-found', [], null, 1.1);
        $this->router->get('/', function() {
            return '<h1>Homepage</h1>';
        }, 'homepage');
        $route = $this->router->match($request);
        $this->assertEquals(null, $route);
    }

    public function testValidGetRequestWithParams() {
        $request = new ServerRequest('GET', '/blog/slug-1', [], null, 1.1);
        $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function() {
            return '<h1>Article</h1>';
        }, 'posts.show');
        $route = $this->router->match($request);
        $this->assertEquals('posts.show', $route->getRouteName());
        $this->assertEquals('<h1>Article</h1>', call_user_func_array($route->getRouteCallback(), [$request]));
        $this->assertEquals(['slug' => 'slug', 'id' => '1'], $route->getRouteParams());
    }

    public function testGetRequestWithIncorrectParams() {
        $request = new ServerRequest('GET', '/blog/slug_1', [], null, 1.1);
        $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function() {
            return '<h1>Article</h1>';
        }, 'posts.show');
        $route = $this->router->match($request);
        $this->assertEquals(null, $route);
    }

    public function testGenerateUriRouteNamed() {
        $this->router->get('/', function() {
            return '<h1>Homepage</h1>';
        }, 'homepage');
        $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function() {
            return '<h1>Article</h1>';
        }, 'posts.show');
        $this->assertEquals('/', $this->router->generateUri('homepage'));
        $this->assertEquals('/blog/slug-1', $this->router->generateUri('posts.show', ['slug' => 'slug', 'id' => 1]));
    }

}