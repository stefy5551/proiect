<?php

namespace App\Controllers;

use App\Models\LoginModel;
use Framework\Controller;

class LoginController extends Controller
{
    public function login() : void
    {
        session_start();
        if(isset($_SESSION))
        {
            if (isset($_SESSION["login_error"]))
            {
                $this->view("login.view.php", ["login_error" => $_SESSION["login_error"]]);
                unset($_SESSION["login_error"]);
                return;
            }
        }
        $this->view("login.view.php");
    }

    public function login_user(array $params) : void
    {
        session_start();

        $user = new LoginModel($params["username"],$params["password"]);
        $is_user_correct = $user->is_user_correct();

        if ($is_user_correct)
        {
            if($user->is_user_admin())
            {
                $_SESSION["admin_logged"] = 1;
                header("Location: /admin/home");
            }
                else
                if($user->is_user_doctor())
                {
                    $_SESSION["doctor_logged"] = 1;
                    header("Location: /doctor/program");
                }
                else
                {
                    $_SESSION["user_logged"] = 1;
                    header("Location: /user/doctors");
                }
        }
        else
        {
            $_SESSION["login_error"] = "Username or password wrong";
            header("Location: /login");
        }
    }
    public function logout() : void
    {
        session_start();
        if(isset($_COOKIE[session_name()]))
            setcookie( session_name(), "", time()-3600, "/" );
        $_SESSION = array();
        session_destroy();
        if(($_SERVER['REQUEST_URI'])!="/login")
        {
            header("Location: /login");
        }
    }
}