<?php

namespace Core\Twig;


use Core\Routing\Router;
use Pagerfanta\Pagerfanta;
use Pagerfanta\View\TwitterBootstrap3View;

class PagerFantaTwigExtension extends \Twig_Extension
{

    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('paginate', [$this, 'paginate'], ['is_safe' => ['html']])
        ];
    }

    public function paginate(Pagerfanta $paginatedResults, string $route, array $queryArgs = []) :string {
        $view = new TwitterBootstrap3View();
        return $view->render($paginatedResults, function (int $page) use ($route, $queryArgs) {
            if($page > 1){
                $queryArgs['p'] = $page;
            }
            return $this->router->generateUri($route, [], $queryArgs);
        });


    }
}