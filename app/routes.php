<?php
namespace App;

$routes = [
    '/user/delete' => ['controller' => 'UserController',
        'action' => 'delete_user'],

    '/user/{id}' => ['controller' => 'UserController',
        'action' => 'get_user'],

    '/user/add' => ['controller' => 'UserController',
        'action' => 'add_user'],

    '/user/view' => ['controller' => 'UserController',
        'action' => 'show'],

    '/auth/show' => ['controller' => 'Authentification',
        'action' => 'show'],

    '/login' => ['controller' => 'Authentification',
        'action' => 'login',
        'params' => [/*empty*/]],

    '/auth/login' => ['controller' => 'Authentification',
        'action' => 'loginAuthAction',
        'params' => ['username', 'password']],

    '/auth/register' => ['controller' => 'Authentification',
        'action' => 'register'],

    '/auth/LoginController.php' => ['controller' => 'login',
        'action' => 'loginUser'],
];
