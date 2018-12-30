<?php
namespace Framework;

class Router
{
    protected $routes;
    public function __construct($routes){
        $this->routes = $routes;
    }
    protected function call_controller_action(string $uri,?array $id):void{


        $controller = $this->routes[$uri]['controller'];
        $action = $this->routes[$uri]['action'];
        $params = $this->routes[$uri]['params'];

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
//        $controller->{$action}($params, $split_query);

        $controller->$action($parameters);

    }
    public function action_by_uri():void{
        $no_action_message = 'no action';
        $is_action = false;

        if (preg_match('/\d+/', $_SERVER['REQUEST_URI'], $id)) {
            $dynamic_uri = preg_replace('/[0-9]+/', '{id}', $_SERVER['REQUEST_URI']);
            if(isset($this->routes[$dynamic_uri])) {
                $this->call_controller_action($dynamic_uri, $id);
                $is_action = true;
            }
        } else {
            $static_uri = $_SERVER['REQUEST_URI'];
            if(isset($this->routes[$static_uri])) {
                $this->call_controller_action($static_uri, null);
                $is_action = true;
            }
        }
        if (!$is_action){
            echo $no_action_message;
        }
    }
}