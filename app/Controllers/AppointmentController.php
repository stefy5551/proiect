<?php
/**
 * Created by PhpStorm.
 * User: Sted
 * Date: 1/5/2019
 * Time: 3:51 PM
 */

namespace App\Controllers;
use App\Models\AppointmentModel;
use Framework\Controller;

class AppointmentController extends Controller
{
    public function make_appointment(array $params)
    {
        session_start();

        $appointment = new AppointmentModel($_SESSION["id"], $params["program_id"]);
        $appointment->make_appointment();
        header("Location: /user/program");
    }
}