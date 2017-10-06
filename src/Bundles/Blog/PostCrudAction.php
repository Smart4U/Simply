<?php

namespace Bundles\Blog;


use Bundles\Blog\Entity\Post;
use Bundles\Blog\Table\PostTable;
use Core\Action\CrudAction;
use Core\Notify\Flash;
use Core\Renderer\RendererInterface;
use Core\Routing\Router;
use DateTime;
use Psr\Http\Message\ServerRequestInterface;

class AdminBlogAction extends CrudAction
{

    protected $viewPath = "@blog/admin/posts";

    protected $routePrefix = "admin.blog";

    public function __construct(RendererInterface $renderer, Router $router, PostTable $table, Flash $flash)
    {
        parent::__construct($renderer, $router, $table, $flash);
    }


    protected function getFields(ServerRequestInterface $request)
    {
        return array_filter($request->getParsedBody(), function ($key) {
            return in_array($key, ['title', 'slug', 'content']);
        }, ARRAY_FILTER_USE_KEY);
    }

    protected function getValidator(ServerRequestInterface $request) {

        return parent::getValidator($request)
            ->required('title', 'slug', 'content')
            ->length('content', 10, 255)
            ->length('title', 2, 255)
            ->length('slug', 2, 255)
            ->slug('slug');
    }

    protected function getNewEntity() {
        $post = new Post();
        $post->created_at = new DateTime();
        return $post;
    }
}
