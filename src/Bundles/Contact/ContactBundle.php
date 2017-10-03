<?php

namespace Bundles\Contact;

use Core\Renderer\RendererInterface;
use Core\Routing\Router;

/**
 * Class ContactBundle
 *
 * Bundle to be contacted by email
 */
class ContactBundle
{

    const DEFINITIONS = __DIR__ . '/settings.php';

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
