<?php
namespace App\Controllers;

class UserController {

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
