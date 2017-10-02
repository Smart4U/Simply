<?php

require '../vendor/autoload.php';

$app = new \Core\App();

\Http\Response\send($app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals()));