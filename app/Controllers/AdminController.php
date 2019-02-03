<?php

namespace App\Controllers;

use Framework\Controller;
use App\Models\AdminModel;

class AdminController extends Controller
{
    public function home() : void
    {
        session_start();

        $admin_model = new AdminModel();
        $users = $admin_model->get_all_users();

        $this->view("admin_home.view.php", ["name" => $_SESSION["name"], "title" => "Users",
            "all_results" => $users]);
    }
    public function delete_user($params) : void
    {
        session_start();

        $admin_model = new AdminModel();
        $admin_model->delete_user($params["user_id"]);
        header("Location: /admin/home");
    }
}