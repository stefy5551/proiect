<?php
namespace Framework;


class Controller
{
    private $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../app/Views');
        $this->twig = new \Twig_Environment($loader, array(
            'views' => __DIR__ . '/../app/Views',
        ));
    }

    public function view(string $viewFile, array $params = [])
    {
        echo $this->twig->render($viewFile, $params);
    }
}
