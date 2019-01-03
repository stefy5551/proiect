<?php

namespace App\Controllers;


use App\Models\Login;
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
    public function submit()
    {
        echo 'submit';
    }
    public function loginAuthAction(array $params)
    {
        $authenticateInstance = new Login($params["username"],$params["password"]);
        $authentificationResult = $authenticateInstance->is_user_correct();
        if ($authentificationResult)
        {
            header("Location: /user/home");
//            return $this->view("show.html", ["name" => "stefannn"]);
        }
        else
        {
            header("Location: /login");
        }
//        return $this->view("login.view.php");
    }
}