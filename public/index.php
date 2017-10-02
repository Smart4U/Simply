<?php

require '../vendor/autoload.php';

$app = new \Core\App([
    \Bundles\Contact\ContactBundle::class
]);

\Http\Response\send($app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals()));
