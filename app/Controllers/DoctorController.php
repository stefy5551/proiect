<?php
namespace App\Controllers;

use Framework\Controller;
use App\Models\DoctorModel;

class DoctorController extends Controller
{
    public function home() : void
    {
        session_start();
        $this->view("doctor_home.view.php", ["name" => $_SESSION["name"]]);
    }

    public function show_appointments() : void
    {
        session_start();

        $doctor = new DoctorModel($_SESSION["username"], "", "", "");
        $all_appointments = $doctor->get_all_appointments();

        $this->view("doctor_app.view.php", ["name" => $_SESSION["name"],"title" => "Appointments", "all_results" => $all_appointments]);

    }

    public function show_program() : void
    {
        session_start();

        $user = new DoctorModel("", "", "", "");
        $programs = $user->get_program();

        $this->view("doctor_progr.view.php", ["name" => $_SESSION["name"], "title" => "Program", "all_results" => $programs]);
    }
}