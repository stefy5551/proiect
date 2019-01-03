<?php
namespace App\Controllers;

use Framework\Controller;
use App\Models\UserModel;

class UserController extends Controller {

    public function home()
    {
        return $this->view("user_home.view.php");
    }
    public function add_user(array $params)
    {
        $user = new UserModel($params["username"], $params["password"], $params["email"]);
        $is_user_successfully_added = $user->add_user();

        if ($is_user_successfully_added)
        {
            header("Location: /user/home");
        }
        else
        {
            header("Location: /register");
        }
    }
}
