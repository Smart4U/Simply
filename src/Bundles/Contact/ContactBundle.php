<?php

namespace Bundles\Contact;

use Core\Renderer\RendererInterface;
use Core\Routing\Router;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class ContactBundle
 *
 * Bundle to be contacted by email
 */
class ContactBundle
{

    /**
     * @var Renderer
     */
    private $renderer;

    /**
     * ContactBundle constructor.
     * @param Router $router
     */
    public function __construct(Router $router, RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addViewPath('contact', __DIR__ . '/Views');
        $router->get('/contact', [$this, 'index'], 'contact.index');
    }


    /**
     * @param ServerRequestInterface $request
     * @return string
     */
    public function index(ServerRequestInterface $request)
    {
        return $this->renderer->render('test.twig');
    }
}
