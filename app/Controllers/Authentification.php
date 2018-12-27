<?php

namespace App\Controllers;


use Framework\Controller;

class Authentification extends Controller
{
    public function show()
    {
        return $this->view("show.html", ["name" => "stefan"]);
    }
    public function login()
    {
        return $this->view("show.html");
    }
}
