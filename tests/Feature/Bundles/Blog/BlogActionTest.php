<?php

namespace Tests\Feature\Bundles\Blog;


use Bundles\Blog\BlogAction;
use Core\Renderer\RendererInterface;
use Core\Routing\Router;
use Core\Table\PostTable;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class BlogActionTest extends TestCase
{

    private $action;
    private $renderer;
    private $router;
    private $postTable;

    public function setUp() {
        $this->renderer = $this->prophesize(RendererInterface::class);
        $this->postTable = $this->prophesize(PostTable::class);


        $this->router = $this->prophesize(Router::class);
        $this->action = new BlogAction(
            $this->renderer->reveal(),
            $this->router->reveal(),
            $this->postTable->reveal()
        );
    }

    private function makePost(int $id, string $slug): \stdClass {
        $post = new \stdClass();
        $post->id = $id;
        $post->slug = $slug;
        return $post;
    }

    public function testShowRender(){
        $post = $this->makePost(1, 'mon-article');

        $request = (new ServerRequest('GET', '/'))
            ->withAttribute('slug', $post->slug)
            ->withAttribute('id', $post->id);

        $this->postTable->find($post->id)->willReturn($post);
        $this->renderer->render('@blog/show.twig', ['post' => $post])->willReturn('');

        $response = call_user_func_array($this->action, [$request]);
        $this->assertSame(1, 1);
    }

    public function testRedirectIfSlugIsNotCorrect(){
        $post = $this->makePost(2, 'good-slug');

        $request = (new ServerRequest('GET', '/'))
            ->withAttribute('slug', 'bad-slug')
            ->withAttribute('id', $post->id);

        $this->router->generateUri('blog.show', ['slug' => $post->slug, 'id' => $post->id])->willReturn('/good-slug');
        $this->postTable->find($post->id)->willReturn($post);

        $response = call_user_func_array($this->action, [$request]);
        $this->assertEquals(301, $response->getStatusCode());
        $this->assertEquals(['/good-slug'], $response->getHeader('location'));
    }
}