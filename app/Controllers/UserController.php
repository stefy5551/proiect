<?php
namespace App\Controllers;

use Framework\Controller;
use App\Models\UserModel;

class UserController extends Controller {

    public function register()
    {
        session_start();
        if(isset($_SESSION))
        {
            if (isset($_SESSION["register_error"]))
            {
                echo $_SESSION["register_error"];
            }
        }
        return $this->view("register.view.php");
    }
    public function doctors()
    {
        session_start();

        $user = new UserModel("", "", "", "");
        $all_doctors = $user->get_all_doctors();

        $this->view("user_home.view.php", ["name" => $_SESSION["name"],"title" => "Doctors", "all_results" => $all_doctors]);
    }
    public function home()
    {
        session_start();
        $this->view("user_home.view.php", ["name" => $_SESSION["name"]]);
    }
    public function add_user(array $params)
    {
        session_start();
        
        $user = new UserModel($params["username"], $params["password"], $params["email"], $params["name"]);
        $is_user_successfully_added = $user->add_user();

        if ($is_user_successfully_added)
        {
            $_SESSION["register_error"] = "";
            header("Location: /user/home");
        }
        else
        {
            $_SESSION["register_error"] = "Something went wrong. Check username and email";
            header("Location: /register");
        }
    }
    public function show_specializations()
    {
        session_start();

        $user = new UserModel("", "", "", "");
        $all_specializations = $user->get_all_specializations();

        $this->view("user_spec.view.php", ["name" => $_SESSION["name"],"title" => "Specializations", "all_results" => $all_specializations]);
    }

    public function show_appointments()
    {
        session_start();

        $user = new UserModel($_SESSION["username"], "", "", "");
        $all_appointments = $user->get_all_appointments();

        $this->view("user_app.view.php", ["name" => $_SESSION["name"],"title" => "Appointments", "all_results" => $all_appointments]);

    }

    public function show_program()
    {
        session_start();

        $_SESSION["doctor_id"] = 21;
        if(isset($_SESSION["doctor_id"]))
        {
            $user = new UserModel("", "", "", "");
            $programs = $user->get_program();

            $this->view("user_progr.view.php", ["name" => $_SESSION["name"],"title" => "Programs", "all_results" => $programs]);
        }
        else
        {
            $this->view("user_progr.view.php", ["name" => $_SESSION["name"]]);
        }
    }

}
