<?php

namespace Bundles\Blog;

use Core\Routing\Router;
use Core\Renderer\RendererInterface;

class BlogBundle
{

    const DEFINITIONS = __DIR__ . '/settings.php';

    const MIGRATIONS = __DIR__ . '/Database/Migrations';

    const SEEDS = __DIR__ . '/Database/Seeds';

    /**
     * ContactBundle constructor.
     * @param Router $router
     */
    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {
        $renderer->addViewPath('blog', __DIR__ . '/Views');
        $router->get($prefix . '/blog', BlogAction::class, 'blog.index');
        $router->get($prefix . '/blog/{slug:[a-z0-9\-]+}-{id:[\d]+}', BlogAction::class, 'blog.show');
    }
}
