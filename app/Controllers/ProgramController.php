<?php
/**
 * Created by PhpStorm.
 * User: Sted
 * Date: 1/11/2019
 * Time: 5:54 PM
 */

namespace App\Controllers;

use App\Models\ProgramModel;
use Framework\Controller;

class ProgramController extends Controller
{
    public function add_available_hour(array $params)
    {
        session_start();

        $program= new ProgramModel($_SESSION["id"], 0, $params["day"], $params["hour"]);
        $program->add_available_hour();
        header("Location: /doctor/program");
    }
    public function remove_available_hour(array $params)
    {
        $program = new ProgramModel(0, $params["program_id"], 0, 0);
        $program->remove_available_hour();
        header("Location: /doctor/program");
    }
}