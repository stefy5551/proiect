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

    '/user/home' => ['controller' => 'UserController',
        'action' => 'home',
        'params' => [/*empty*/]],



    '/login' => ['controller' => 'Authentification',
        'action' => 'login',
        'params' => [/*empty*/]],

    '/auth/login' => ['controller' => 'Authentification',
        'action' => 'loginAuthAction',
        'params' => ['username', 'password']],

    '/register' => ['controller' => 'Authentification',
        'action' => 'register',
        'params' => [/*empty*/]],

    '/auth/register' => ['controller' => 'UserController',
        'action' => 'add_user',
        'params' => ['username', 'password', 'email']]
];
