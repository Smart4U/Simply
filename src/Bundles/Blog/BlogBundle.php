<?php

namespace Bundles\Blog;

use Core\Renderer\RendererInterface;
use Core\Routing\Router;
use Psr\Container\ContainerInterface;

class BlogBundle
{

    const DEFINITIONS = __DIR__ . '/settings.php';

    const MIGRATIONS = __DIR__ . '/Database/Migrations';

    const SEEDS = __DIR__ . '/Database/Seeds';


    /**
     * BlogBundle constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $container->get(RendererInterface::class)->addViewPath('blog', __DIR__ . '/Views');

        $blogPrefix = $container->get('blog.prefix');

        $router = $container->get(Router::class);
        $router->get("$blogPrefix", BlogAction::class, 'blog.index');
        $router->get("$blogPrefix/{slug:[a-z0-9\-]+}-{id:[\d]+}", BlogAction::class, 'blog.show');

        if ($container->has('admin.prefix')) {
            $adminPrefix = $container->get('admin.prefix');
            $router->crud("$adminPrefix/posts", AdminBlogAction::class, 'admin.blog');
        }
    }
}
