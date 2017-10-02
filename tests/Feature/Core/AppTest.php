<?php

namespace Tests;

use Bundles\Contact\ContactBundle;
use Core\App;

use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{

    public function testAvoidDuplicateContent() {
        $app = new App();
        $request = new ServerRequest('GET','/uri-avoid-duplicate-content/');
        $response = $app->run($request);

        $this->assertContains('/uri-avoid-duplicate-content', $response->getHeader('Location'));
        $this->assertSame(301, $response->getStatusCode());
    }

    public function testHasBeenLoadedContactBundle() {
        $app = new App([
            ContactBundle::class
        ]);
        $request = new ServerRequest('GET','/contact');
        $response = $app->run($request);

        $this->assertContains('<h1>Contact</h1>', (string)$response->getBody());
        $this->assertSame(200, $response->getStatusCode());

    }

}