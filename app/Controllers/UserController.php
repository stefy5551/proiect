<?php
namespace App\Controllers;

use Framework\Controller;

class UserController extends Controller {

    public function __construct() {
    }

    public function get_user($id){
        echo 'user: ';
        echo $id;
    }

    public function add_user(){
        echo 'user added';
    }

    public function delete_user(){
        echo 'user deleted';
    }
}
