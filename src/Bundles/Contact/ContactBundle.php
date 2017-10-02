<?php

namespace Bundles\Contact;

use Core\Routing\Router;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class ContactBundle
 *
 * Bundle to be contacted by email
 */
class ContactBundle
{

    /**
     * ContactBundle constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $router->get('/contact', [$this, 'index'], 'contact.index');
    }


    /**
     * @param ServerRequestInterface $request
     * @return string
     */
    public function index(ServerRequestInterface $request)
    {
        return '<h1>Contact</h1>';
    }
}
