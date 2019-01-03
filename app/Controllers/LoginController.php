<?php

namespace App\Controllers;

use App\Models\LoginModel;
use Framework\Controller;

class LoginController extends Controller
{
    public function login()
    {
        return $this->view("login.view.php");
    }
    public function register()
    {
        return $this->view("register.view.php");
    }
    public function login_user(array $params)
    {
        $user = new LoginModel($params["username"],$params["password"]);
        $is_user_correct = $user->is_user_correct();

        if ($is_user_correct)
        {
            header("Location: /user/home");
        }
        else
        {
            header("Location: /login");
        }
    }
}