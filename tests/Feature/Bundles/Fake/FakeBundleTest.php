<?php

namespace Tests\Feature\Bundles\Fake;


use Core\App;
use Core\Routing\Router;
use GuzzleHttp\Psr7\ServerRequest;

use PHPUnit\Framework\TestCase;

class FakeBundle {

    public function __construct(Router $router)
    {
        $router->get('/fakebundle', function() { ['is_not_correct_response']; }, 'fakebundle');
    }

}

class FakeBundleTest extends TestCase
{

    public function testThrowExceptionWithInvalidResponse() {
        $app = new App([FakeBundle::class]);
        $request = new ServerRequest('GET', '/fakebundle', [], null, 1.1);

        $this->expectException(\RuntimeException::class);
        $app->run($request);
    }


}