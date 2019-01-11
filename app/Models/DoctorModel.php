<?php
/**
 * Created by PhpStorm.
 * User: Sted
 * Date: 1/11/2019
 * Time: 4:15 PM
 */

namespace App\Models;


use Framework\Model;

class DoctorModel extends Model
{
    protected $table = "users";

    private $username;
    private $password;
    private $email;
    private $name;
    private $pdo;

    function __CONSTRUCT(string $username, string $password, string $email, string $name)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->name = $name;
        $this->pdo = $this->newDbCon();
    }
    function initiate_session($result)
    {
        $_SESSION["id"] = $result->id;
        $_SESSION["name"] = $result->name;
        $_SESSION["username"]=$result->username;
        $_SESSION["email"]=$result->email;
        $_SESSION["is_doctor"]=$result->is_doctor;
        $_SESSION["specialization"]=$result->specialization;
    }
    function get_all_appointments()
    {
        $query = "SELECT days.day, hours.start_hour, users.*, program.id FROM users
                  INNER JOIN appointments on users.id = appointments.id_user
                  INNER JOIN program on appointments.id_program = program.id
                  INNER JOIN days on days.id = program.id_day
                  INNER JOIN hours on hours.id = program.id_hour ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function get_program()
    {
        $query = "SELECT days.day, hours.start_hour, users.*, program.id, program.available FROM users
                  INNER JOIN program on (?) = program.id_medic
                  INNER JOIN days on days.id = program.id_day
                  INNER JOIN hours on hours.id = program.id_hour where program.available = 1
                  group by program.id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$_SESSION["id"]]);
        return $stmt->fetchAll();
    }
    private function get_items(string $query)
    {
        $db = $this->newDbCon();
        $stmt = $db->query($query);
        return $stmt->fetchAll();
    }
}