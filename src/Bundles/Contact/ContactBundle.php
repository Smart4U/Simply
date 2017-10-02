<?php

namespace Bundles\Contact;

use Core\Routing\Router;
use Core\Renderer\Renderer;

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
    public function __construct(Router $router, Renderer $renderer)
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
        return $this->renderer->render('@contact/index.php');
    }
}
