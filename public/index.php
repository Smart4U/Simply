<?php

require '../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/resources/views');
$twig = new Twig_Environment($loader, []);

$app = new \Core\App([
    \Bundles\Contact\ContactBundle::class
]);

\Http\Response\send($app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals()));
