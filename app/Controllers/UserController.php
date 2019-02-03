<?php
namespace App\Controllers;

use Framework\Controller;
use App\Models\UserModel;

class UserController extends Controller {


    public function show_doctors() : void
    {
        session_start();

        $user = new UserModel("", "", "", "");
        $all_doctors = $user->get_all_doctors();

        $this->view("user_home.view.php", ["name" => $_SESSION["name"],"title" => "Doctors",
            "all_results" => $all_doctors]);
        print_r($_SESSION);
    }
    public function show_specializations() : void
    {
        session_start();

        $user = new UserModel("", "", "", "");
        $all_specializations = $user->get_all_specializations();

        $this->view("user_spec.view.php", ["name" => $_SESSION["name"],"title" => "Specializations",
            "all_results" => $all_specializations]);
    }

    public function show_appointments() : void
    {
        session_start();

        $user = new UserModel($_SESSION["username"], "", "", "");
        $all_appointments = $user->get_all_appointments();

        $this->view("user_app.view.php", ["name" => $_SESSION["name"],"title" => "Appointments",
            "all_results" => $all_appointments]);
    }

    public function show_program() : void
    {
        session_start();

        $user = new UserModel("", "", "", "");
        $programs = $user->get_program();

        $this->view("user_progr.view.php", ["name" => $_SESSION["name"],"title" => "Programs",
            "all_results" => $programs]);
    }
}
