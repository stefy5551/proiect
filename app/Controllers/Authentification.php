<?php
/**
 * Created by PhpStorm.
 * User: Sted
 * Date: 12/11/2018
 * Time: 10:38 AM
 */

namespace App\Controllers;


use Framework\Controller;

class Authentification extends Controller
{
    public function show()
    {
        return $this->view("authentification.html");
    }
}