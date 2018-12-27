<?php

namespace App\Controllers;


use Framework\Controller;

class Authentification extends Controller
{
    public function show()
    {
        echo 'show';
        return $this->view("show.html", ["name" => "stefannn"]);
    }
    public function login()
    {
        echo 'login';
        return $this->view("login.html");
    }
}