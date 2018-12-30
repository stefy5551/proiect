<?php

namespace App\Controllers;

use Framework\Controller;
class LoginController extends Controller
{
    function loginUser(string $username,string $password)
    {
        $username = "dasda";
        $password = "parola";
        echo $username;
        echo $password;
        echo 'da';
        echo User::login($username, $password);
    }
    public function loginAuthAction(array $params)
    {
//        echo 'da';
//        $authenticateInstance = new Login($params["username"],$params["password"]);
//        $authentificationResult = $authenticateInstance->is_user_correct();
//        $authenticateInstance->redirectAuthenticationForm($authentificationResult);
//        // /login/auth
    }
}