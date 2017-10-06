<?php

namespace Bundles\Blog;

use Bundles\Blog\Table\PostTable;
use Core\Notify\Flash;
use Core\Routing\Router;
use Core\Renderer\RendererInterface;
use Core\Session\SessionInterface;
use Core\Validator\Validator;
use Psr\Http\Message\ServerRequestInterface;

class AdminBlogAction
{

    private $postTable;
    private $router;
    private $renderer;
    private $flash;

    public function __construct(RendererInterface $renderer, Router $router, PostTable $postTable, Flash $flash)
    {
        $this->postTable = $postTable;
        $this->router = $router;
        $this->renderer = $renderer;
        $this->flash = $flash;
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
        $posts = $this->postTable->findPaginated(10, $params['p'] ?? 1);

        return $this->renderer->render('@blog/admin/index.twig', compact('posts'));
    }

    public function create(ServerRequestInterface $request)
    {
        if ($request->getMethod() === 'POST') {
            $params = $this->getFields($request);
            $params = array_merge($params, [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $validator = $this->getValidator($request);
            if($validator->isValid()) {
                $this->postTable->insert($params);
                $this->flash->success('article ajouté');
                $indexURI = $this->router->generateUri('admin.blog.index');
                header("Location: $indexURI");
                exit();
            }
            $errors = $validator->getErrors();
            $item = $params;

        }
        return $this->renderer->render('@blog/admin/create.twig', compact('item', 'errors'));
    }

    public function edit(ServerRequestInterface $request)
    {
        $item = $this->postTable->find($request->getAttribute('id'));

        if ($request->getMethod() === 'POST') {
            $params = $this->getFields($request);
            $params['updated_at'] = date('Y-m-d H:i:s');

            $validator = $this->getValidator($request);
            if($validator->isValid()) {
                $this->postTable->update($item->id, $params);
                $this->flash->success('article modifié');
                $indexURI = $this->router->generateUri('admin.blog.index');
                header("Location: $indexURI");
                exit();
            }
            $errors = $validator->getErrors();
            $params['id'] = $item->id;
            $item = $params;


        }
        return $this->renderer->render('@blog/admin/edit.twig', compact('item', 'errors'));
    }

    public function delete(ServerRequestInterface $request) :bool
    {
        $this->postTable->delete($request->getAttribute('id'));
        $this->flash->success('article supprimé');

        $indexURI = $this->router->generateUri('admin.blog.index');
        header("Location: $indexURI");
        exit();
    }

    private function getFields(ServerRequestInterface $request)
    {
        return array_filter($request->getParsedBody(), function ($key) {
            return in_array($key, ['title', 'slug', 'content']);
        }, ARRAY_FILTER_USE_KEY);
    }

    private function getValidator(ServerRequestInterface $request) {
        return (new Validator($request->getParsedBody()))
            ->required('title', 'slug', 'content')
            ->length('content', 10, 255)
            ->length('title', 2, 255)
            ->length('slug', 2, 255)
            ->slug('slug');
    }
}
