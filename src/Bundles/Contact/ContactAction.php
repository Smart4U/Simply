<?php

namespace Bundles\Contact;

use Core\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class ContactAction
{

    private $renderer;

    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        return $this->index($request);
    }

    public function index(ServerRequestInterface $request)
    {
        return $this->renderer->render('index.twig');
    }
}
