<?php
/**
 * Created by PhpStorm.
 * User: Sted
 * Date: 12/11/2018
 * Time: 11:21 AM
 */

namespace App\Controllers;


use Framework\Controller;

class Authentification extends Controller
{
    public function show()
    {
        return $this->view("show.html", ["name" => "stefan"]);
    }
}