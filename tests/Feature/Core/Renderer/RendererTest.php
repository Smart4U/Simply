<?php

namespace Feature\Core\Renderer;


use Core\Renderer\Renderer;
use PHPUnit\Framework\TestCase;

class RendererTest extends TestCase
{

    private $renderer;

    public function setUp()
    {
        $this->renderer = new Renderer();
        $this->renderer->addViewPath(dirname(dirname(__DIR__)). '/resources/views');
    }

    public function testRenderTheDefaultViewPath()
    {
        $content = $this->renderer->render('default.php');
        $this->assertEquals('default', $content);
    }

    public function testRenderCustomViewPath()
    {
        $this->renderer->addViewPath('custom',  dirname(dirname(__DIR__)). '/views');
        $content = $this->renderer->render('@custom/custom.php');
        $this->assertEquals('custom', $content);
    }

    public function testRenderWithParams() {
        $content = $this->renderer->render('test_with_params.php', ['var' => 'value']);
        $this->assertEquals('the value', $content);
    }

    public function testGlobalParameters() {
        $this->renderer->addGlobal('var', 'value');
        $content = $this->renderer->render('test_with_params.php');
        $this->assertEquals('the value', $content);
    }

}
