<?php
namespace App\Controllers;
use Framework\Model;

class User extends Model
{
//we have to set specify the corresponding model for the table
    protected $table = "users";

    public function get_name_by_id($id)
    {
        return $this->get($id);
    }

}
