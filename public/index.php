<?php
    require __DIR__ . '/../vendor/autoload.php';

    require_once "../app/config.php";
    require_once "../src/Router.php";
    require_once "../app/routes.php";

    use App\Config;

    ini_set("error_log", __DIR__."/../logs/error.log");
    error_reporting(E_ALL);
    ini_set("display_errors", 0);

    if (Config::ENV == "dev"){
        ini_set("display_errors", 1);
    }
    $router = new Framework\Router($routes);
    $router->action_by_uri();
