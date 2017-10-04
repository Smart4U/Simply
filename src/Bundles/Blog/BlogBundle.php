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

        $router = $container->get(Router::class);
        $router->get($container->get('blog.prefix') . '/blog', BlogAction::class, 'blog.index');
        $router->get($container->get('blog.prefix') . '/blog/{slug:[a-z0-9\-]+}-{id:[\d]+}', BlogAction::class, 'blog.show');

        if($container->has('admin.prefix')){
            $prefix = $container->get('admin.prefix');
            $router->get("$prefix/blog", BlogAction::class, 'admin.blog.index');
        }
    }
}
