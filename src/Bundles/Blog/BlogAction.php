<?php

namespace Bundles\Blog;

use Core\Routing\Router;
use Core\Renderer\RendererInterface;
use Core\Table\PostTable;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

class BlogAction
{

    private $postTable;
    private $router;
    private $renderer;

    public function __construct(RendererInterface $renderer, Router $router, PostTable $postTable)
    {
        $this->postTable = $postTable;
        $this->router = $router;
        $this->renderer = $renderer;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        if ($request->getAttribute('id')) {
            return $this->show($request);
        }
        return $this->index($request);
    }

    public function index(ServerRequestInterface $request)
    {
        $params = $request->getQueryParams();
        $posts = $this->postTable->findForPaginate(10, $params['p'] ?? 1);
        return $this->renderer->render('@blog/index.twig', compact('posts'));
    }

    public function show(ServerRequestInterface $request)
    {
        $post = $this->postTable->find($request->getAttribute('id'));
        if ($post->slug !== $request->getAttribute('slug')) {
            return (new Response(301, ['location' => $this->router->generateUri('blog.show', ['slug' => $post->slug, 'id' => $post->id])], null, 1.1));
        }
        return $this->renderer->render('@blog/show.twig', compact('post'));
    }
}
