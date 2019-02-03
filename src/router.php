<?php
namespace Framework;

class Router
{
    protected $routes;
    public function __construct($routes){
        $this->routes = $routes;
    }
    private function checkGuard(string $route): void
    {
        if (isset($this->routes[$route]['guard']))
        {
            $guard = "\\App\\Guards\\".$this->routes[$route]['guard'];
            (new $guard)->handle();
        }
    }
    protected function call_controller_action(string $url) : void
    {
        $this->checkGuard($url);

        $controller = $this->routes[$url]['controller'];
        $action = $this->routes[$url]['action'];
        $params = $this->routes[$url]['params'];

        $controller = "App\\Controllers\\".$controller;
        $controller = new $controller();

        $parameters = [];
        foreach ($params as $param)
        {
            $parameters[$param] = null;
            if (isset($_POST[$param]))
            {
                $parameters[$param] = $_POST[$param];
            }
        }
        $controller->$action($parameters);
    }
    public function action_by_uri():void{
        $is_action = false;

        if (preg_match('/\d+/', $_SERVER['REQUEST_URI'], $id)) {
            $dynamic_uri = preg_replace('/[0-9]+/', '{id}', $_SERVER['REQUEST_URI']);
            if(isset($this->routes[$dynamic_uri])) {
                $this->call_controller_action($dynamic_uri);
                $is_action = true;
            }
        } else {
            $static_uri = $_SERVER['REQUEST_URI'];
            if(isset($this->routes[$static_uri])) {
                $this->call_controller_action($static_uri);
                $is_action = true;
            }
        }
        if (!$is_action){
            header("Location: /login");
        }
    }
}