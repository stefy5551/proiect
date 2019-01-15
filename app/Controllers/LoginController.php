<?php

namespace App\Controllers;

use App\Models\LoginModel;
use Framework\Controller;

class LoginController extends Controller
{
    public function login()
    {
        session_start();
        if(isset($_SESSION))
        {
            if (isset($_SESSION["login_error"]))
            {
                echo $_SESSION["login_error"];
            }
        }
        return $this->view("login.view.php");
    }

    public function login_user(array $params)
    {
        session_start();

        $user = new LoginModel($params["username"],$params["password"]);
        $is_user_correct = $user->is_user_correct();

        if ($is_user_correct)
        {
            $_SESSION["login_error"] = "";
            if($user->is_user_admin())
                header("Location: /admin/home");
            else
                if($user->is_user_doctor())
                    header("Location: /doctor/home");
                else
                    header("Location: /user/home");
        }
        else
        {
            $_SESSION["login_error"] = "Username or password wrong";
            header("Location: /login");
        }
    }
    public function logout()
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