<?php
namespace App\Controllers;
use Framework\Model;

class User extends Model
{
//we have to set specify the corresponding model for the table
    protected $table = "users";
}
