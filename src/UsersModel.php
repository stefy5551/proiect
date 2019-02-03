<?php
/**
 * Created by PhpStorm.
 * User: Sted
 * Date: 2/3/2019
 * Time: 5:35 PM
 */

namespace Framework;


class UsersModel extends Model
{
    protected $username;
    protected $password;
    protected $email;
    protected $name;
    protected $is_doctor;
    protected $specialization;

    protected function get_user()
    {
        $result = $this->get("username", $this->username);
        $this->password = $result['password'];
        $this->email = $result['email'];
        $this->name = $result['name'];
        $this->specialization = $result['specialization'];
        $this->is_doctor = $result['is_doctor'];
}
}