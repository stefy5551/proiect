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
        'action' => 'show']
];
