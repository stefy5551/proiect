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
    '/register' => ['controller' => 'RegisterController',
        'action' => 'register',
        'params' => [/*empty*/]],

    '/auth/register' => ['controller' => 'RegisterController',
        'action' => 'add_user',
        'params' => ['username', 'password', 'email', 'name', 'specialization', 'is_doctor']],

    # USER

    '/user/logout' => ['controller' => 'LoginController',
        'action' => 'logout',
        'guard' => 'Authenticated',
        'params' => [/*empty*/]],

    '/user/doctors' => ['controller' => 'UserController',
        'action' => 'show_doctors',
        'guard' => 'Authenticated',
        'params' => [/*empty*/]],

    '/user/specializations' => ['controller' => 'UserController',
        'action' => 'show_specializations',
        'guard' => 'Authenticated',
        'params' => [/*empty*/]],

    '/user/appointments' => ['controller' => 'UserController',
        'action' => 'show_appointments',
        'guard' => 'Authenticated',
        'params' => [/*empty*/]],

    '/user/program' => ['controller' => 'UserController',
        'action' => 'show_program',
        'guard' => 'Authenticated',
        'params' => [/*empty*/]],

    '/user/make_appointment' => ['controller' => 'AppointmentController',
        'action' => 'make_appointment',
        'guard' => 'Authenticated',
        'params' => ['program_id']],

    '/user/cancel_appointment' => ['controller' => 'AppointmentController',
        'action' => 'cancel_appointment',
        'guard' => 'Authenticated',
        'params' => ['program_id']],

    # DOCTOR
    '/doctor/home' => ['controller' => 'DoctorController',
        'action' => 'home',
        'guard' => 'Authenticated',
        'params' => [/*empty*/]],

    '/doctor/logout' => ['controller' => 'LoginController',
        'action' => 'logout',
        'guard' => 'Authenticated',
        'params' => [/*empty*/]],

    '/doctor/appointments' => ['controller' => 'DoctorController',
        'action' => 'show_appointments',
        'guard' => 'Authenticated',
        'params' => [/*empty*/]],

    '/doctor/program' => ['controller' => 'DoctorController',
        'action' => 'show_program',
        'guard' => 'Authenticated',
        'params' => [/*empty*/]],

    '/doctor/cancel_appointment' => ['controller' => 'AppointmentController',
        'action' => 'cancel_appointment',
        'guard' => 'Authenticated',
        'params' => ['program_id']],

    '/doctor/add_available_hour' => ['controller' => 'ProgramController',
        'action' => 'add_available_hour',
        'guard' => 'Authenticated',
        'params' => ['day', 'hour']],

    '/doctor/remove_available_hour' => ['controller' => 'ProgramController',
        'action' => 'remove_available_hour',
        'guard' => 'Authenticated',
        'params' => ['program_id']],

    '/admin/home' => ['controller' => 'AdminController',
        'action' => 'home',
        'guard' => 'Authenticated',
        'params' => [/*empty*/]],

    '/admin/logout' => ['controller' => 'LoginController',
        'action' => 'logout',
        'guard' => 'Authenticated',
        'params' => [/*empty*/]],

    '/admin/delete_user' => ['controller' => 'AdminController',
        'action' => 'delete_user',
        'guard' => 'Authenticated',
        'params' => ['user_id']],



];
