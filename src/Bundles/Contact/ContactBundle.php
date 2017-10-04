<?php

namespace Bundles\Contact;

use Core\Routing\Router;
use Core\Renderer\RendererInterface;
use Psr\Container\ContainerInterface;

/**
 * Class ContactBundle
 *
 * Bundle to be contacted by email
 */
class ContactBundle
{

    const DEFINITIONS = __DIR__ . '/settings.php';

    const MIGRATIONS = null;

    const SEEDS = null;

    /**
     * ContactBundle constructor.
     * @param Router $router
     */
    public function __construct(ContainerInterface $container)
    {
        $container->get(RendererInterface::class)->addViewPath('contact', __DIR__ . '/Views');
        $router = $container->get(Router::class);
        $router->get($container->get('contact.prefix') . '/contact', ContactAction::class, 'contact.index');
    }
}
