<?php

namespace App\Controllers;

use App\Models\UserModel;
use Framework\Controller;

class RegisterController extends Controller
{
    public function register() : void
    {
        session_start();
        if(isset($_SESSION))
        {
            if (isset($_SESSION["register_error"]))
            {
                echo $_SESSION["register_error"];
            }
        }
        $this->view("register.view.php");
    }

    public function add_user(array $params) : void
    {
        session_start();
        if(isset($params['is_doctor']) == 1)
        {
            $user = new UserModel($params["username"], $params["password"], $params["email"], $params["name"],
                                    $params["is_doctor"], $params["specialization"]);
            $is_user_successfully_added = $user->add_user();
        }
        else
        {
            $user = new UserModel($params["username"], $params["password"], $params["email"], $params["name"]);
            $is_user_successfully_added = $user->add_user();
        }
        if ($is_user_successfully_added)
        {
            $_SESSION["register_error"] = "";
            if(isset($params['is_doctor']) == 1)
                header("Location: /doctor/program");
            else
                header("Location: /user/doctors");
        }
        else
        {
            $_SESSION["register_error"] = "Something went wrong. Check username and email";
            header("Location: /register");
        }
    }
}