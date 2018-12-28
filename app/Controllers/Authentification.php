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
        return $this->view("login.view.php");
    }
    public function register()
    {
        return $this->view("register.view.php");
    }
}