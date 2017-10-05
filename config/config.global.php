<?php

return [
    // SETTINGS
    'views.path' => dirname(__DIR__) . '/resources/views',
    'twig.extensions' => [
        \DI\get(\Core\Twig\RouterTwigExtension::class),
        \DI\get(\Core\Twig\PagerFantaTwigExtension::class),
        \DI\get(\Core\Twig\TextTwigExtension::class)
    ],
    // ROUTING
    \Core\Routing\Router::class => \DI\object(),

    // VIEWS
    \Core\Renderer\RendererInterface::class => \DI\factory(\Core\Renderer\TwigRendererFactory::class),

    //DATABASE
    'db.host' => 'localhost',
    'db.port' => 3306,
    'db.name' => 'simply',
    'db.user' => 'root',
    'db.pass' => 'toor',
    PDO::class => function(\Psr\Container\ContainerInterface $container) {
        return new PDO('mysql:host=' . $container->get('db.host') . ';dbname=' . $container->get('db.name'),  $container->get('db.user'),  $container->get('db.pass'), [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
];