<?php
namespace App\Controllers;

use Framework\Controller;
use App\Models\User;

class UserController extends Controller {

    public function get_user(array $params, $id){
        echo 'user: ';
        echo $id;
    }
    public function home()
    {
        return $this->view("user_home.view.php");
    }
    public function add_user(array $params)
    {
        $authenticateInstance = new User($params["username"], $params["password"], $params["email"]);
        $authentificationResult = $authenticateInstance->add_user();
        echo $authentificationResult;
        if ($authentificationResult)
        {
            header("Location: /user/home");
//            return $this->view("user_home.view.php", ["name" => "stefannn"]);
        }
        else
        {
            header("Location: /register");
        }
//        return $this->view("register.view.php");
    }

    public function delete_user(){
        echo 'user deleted';
    }

//    public function show()
//    {
//        return $this->view("show.html", ["name" => "stefan"]);
//    }


}
