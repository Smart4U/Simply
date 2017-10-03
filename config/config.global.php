<?php

return [
    // SETTINGS
    'views.path' => dirname(__DIR__) . '/resources/views',
    'twig.extensions' => [
        \DI\get(\Core\Twig\RouterTwigExtension::class)
    ],
    // ROUTING
    \Core\Routing\Router::class => \DI\object(),

    // VIEWS
    \Core\Renderer\RendererInterface::class => \DI\factory(\Core\Renderer\TwigRendererFactory::class)
];