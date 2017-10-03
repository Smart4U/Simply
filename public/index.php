<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$bundles = [
    \Bundles\Contact\ContactBundle::class,
    \Bundles\Blog\BlogBundle::class
];

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions(require dirname(__DIR__) . '/config/config.global.php');
foreach ($bundles as $bundle) {
    if ($bundle::DEFINITIONS) {
        $builder->addDefinitions($bundle::DEFINITIONS);
    }
}
$builder->addDefinitions(require dirname(__DIR__) . '/config.php');
$container = $builder->build();

$app = new \Core\App($container, $bundles);

if (php_sapi_name() !== 'cli') {
    \Http\Response\send($app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals()));
}
