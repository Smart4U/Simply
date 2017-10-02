<?php

namespace Tests\Feature\Bundles\Contact;


use Core\App;
use Core\Routing\Router;
use GuzzleHttp\Psr7\ServerRequest;

use PHPUnit\Framework\TestCase;

class ContactBundle {

    public function __construct(Router $router)
    {
        $router->get('/test-contact', function() { return 'test contact loaded'; }, 'test-contact');
    }

}

class ContactBundleTest extends TestCase
{

    public function testThrowExceptionWithInvalidResponse() {
        $app = new App([ContactBundle::class]);
        $request = new ServerRequest('GET', '/test-contact', [], null, 1.1);
        $app->run($request);
    }


}