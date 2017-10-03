<?php

namespace Bundles\Contact;

use Core\Routing\Router;
use Core\Renderer\RendererInterface;

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
    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {
        $renderer->addViewPath('contact', __DIR__ . '/Views');
        $router->get($prefix . '/contact', ContactAction::class, 'contact.index');
    }
}
