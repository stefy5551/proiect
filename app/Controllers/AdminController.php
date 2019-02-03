<?php

namespace App\Controllers;

use Framework\Controller;
use App\Models\AdminModel;

class AdminController extends Controller
{
    public function home() : void
    {
        session_start();

        $admin_model = new AdminModel("", "", "", "", 0);

        $users = $admin_model->get_all_users();

        $this->view("admin_home.view.php", ["name" => $_SESSION["username"], "title" => "Users",
            "all_results" => $users]);
    }
    public function delete_user($params) : void
    {
        session_start();

        $admin_model = new AdminModel("", "", "", "", $params["user_id"]);
        $admin_model->delete_user();

        $users = $admin_model->get_all_users();
        $this->view("admin_home.view.php", ["name" => $_SESSION["username"], "title" => "Users",
            "all_results" => $users]);
    }
}