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

    private $pdo;

    public function __CONSTRUCT()
    {
        $this->pdo = $this->newDbCon();
    }
    public function get_all_appointments()
    {
        $query = "SELECT program.day, program.start_hour, users.*, program.id FROM users
                  INNER JOIN appointments on users.id = appointments.id_user
                  INNER JOIN program on appointments.id_program = program.id
                  where program.id_medic = (?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$_SESSION["id"]]);
        return $stmt->fetchAll();
    }
    public function get_program()
    {
        $query = "SELECT program.day, program.start_hour, users.*, program.id, program.available FROM users
                  INNER JOIN program on (?) = program.id_medic
                  where program.available = 1
                  group by program.id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$_SESSION["id"]]);
        return $stmt->fetchAll();
    }
}