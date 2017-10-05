<?php

namespace Bundles\Blog;

use Bundles\Blog\Entity\Post;
use Core\Routing\Router;
use Core\Renderer\RendererInterface;
use Core\Table\PostTable;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

class AdminBlogAction
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

    public function __invoke(ServerRequestInterface $request) :string
    {
        if ($request->getMethod() === 'DELETE') {
            return $this->delete($request);
        }
        if (substr((string)$request->getUri(), -3) === 'add') {
            return $this->create($request);
        }
        if ($request->getAttribute('id')) {
            return $this->edit($request);
        }
        return $this->index($request);
    }

    public function index(ServerRequestInterface $request) :string
    {
        $params = $request->getQueryParams();
        $posts = $this->postTable->findForPaginate(10, $params['p'] ?? 1);
        return $this->renderer->render('@blog/admin/index.twig', compact('posts'));
    }

    public function create(ServerRequestInterface $request)
    {
        if ($request->getMethod() === 'POST') {
            $params = $this->guarded($request);
            $params = array_merge($params, [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $this->postTable->insert($params);

            $indexURI = $this->router->generateUri('admin.blog.index');
            header("Location: $indexURI");
            exit();
        }
        return $this->renderer->render('@blog/admin/create.twig');



        return $this->renderer->render('@blog/admin/edit.twig', compact('post'));
    }

    public function edit(ServerRequestInterface $request)
    {
        $item = $this->postTable->find($request->getAttribute('id'));

        if ($request->getMethod() === 'POST') {
            $params = $this->guarded($request);
            $params['updated_at'] = date('Y-m-d H:i:s');

            $this->postTable->update($item->id, $params);

            $indexURI = $this->router->generateUri('admin.blog.index');
            header("Location: $indexURI");
            exit();
        }
        return $this->renderer->render('@blog/admin/edit.twig', compact('item'));
    }

    public function delete(ServerRequestInterface $request) :bool
    {
        $this->postTable->delete($request->getAttribute('id'));
        $indexURI = $this->router->generateUri('admin.blog.index');
        header("Location: $indexURI");
        exit();
    }

    private function guarded(ServerRequestInterface $request)
    {
        return array_filter($request->getParsedBody(), function ($key) {
            return in_array($key, ['title', 'slug', 'content']);
        }, ARRAY_FILTER_USE_KEY);
    }
}
