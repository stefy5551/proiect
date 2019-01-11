<?php
namespace App;

$routes = [

    # LOGIN
    '/login' => ['controller' => 'LoginController',
        'action' => 'login',
        'params' => [/*empty*/]],

    '/auth/login' => ['controller' => 'LoginController',
        'action' => 'login_user',
        'params' => ['username', 'password']],

    # REGISTER
    '/register' => ['controller' => 'UserController',
        'action' => 'register',
        'params' => [/*empty*/]],

    '/auth/register' => ['controller' => 'UserController',
        'action' => 'add_user',
        'params' => ['username', 'password', 'email', 'name']],

    # USER

    '/user/home' => ['controller' => 'UserController',
        'action' => 'home',
        'params' => [/*empty*/]],

    '/user/logout' => ['controller' => 'LoginController',
        'action' => 'logout',
        'params' => [/*empty*/]],

    '/user/doctors' => ['controller' => 'UserController',
        'action' => 'doctors',
        'params' => [/*empty*/]],

    '/user/specializations' => ['controller' => 'UserController',
        'action' => 'show_specializations',
        'params' => [/*empty*/]],

    '/user/appointments' => ['controller' => 'UserController',
        'action' => 'show_appointments',
        'params' => [/*empty*/]],

    '/user/program' => ['controller' => 'UserController',
        'action' => 'show_program',
        'params' => [/*empty*/]],

    '/user/make_appointment' => ['controller' => 'AppointmentController',
        'action' => 'make_appointment',
        'params' => ['program_id']],

    '/user/cancel_appointment' => ['controller' => 'AppointmentController',
        'action' => 'cancel_appointment',
        'params' => ['program_id']]
];
