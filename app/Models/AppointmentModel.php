<?php
namespace App\Models;
use Framework\Model;

class AppointmentModel extends Model
{
    private $id_user;
    private $id_program;
    private $pdo;

    function __CONSTRUCT($id_user, $id_program)
    {
        $this->id_user = $id_user;
        $this->id_program = $id_program;
        $this->pdo = $this->newDbCon();
    }
    function is_id_user_valid()
    {
        $query = "SELECT * from users WHERE id = (?)";
        return $this->is_item_valid($query, $this->id_user);
    }
    function is_id_program_valid()
    {
        $query = "SELECT * from program WHERE id = (?)";
        return $this->is_item_valid($query, $this->id_program);
    }
    function is_program_available()
    {
        $query = "SELECT available from program WHERE id = (?)";
        return $this->is_item_valid($query, $this->id_program);
    }
    function is_item_valid(string $query, $id)
    {
        $sql = $query;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result)
        {
            return TRUE;
        }
        return FALSE;
    }

    function add_appointment_query()
    {
        $sql = "INSERT INTO `appointments`(id_user, id_program) VALUES(?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->id_user, $this->id_program]);
    }

    function modify_availability(bool $value)
    {
        $sql = "UPDATE program  SET Available = (?) WHERE id = (?);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$value, $this->id_program]);
    }
    function make_appointment()
    {
        if($this->is_id_user_valid() and $this->is_id_program_valid() and $this->is_program_available())
        {
            $this->add_appointment_query();
            $this->modify_availability(False);
        }
    }
    function cancel_appointment_query()
    {
//        $sql = "DELETE from appointments
//                where id_program = 1";
        $sql = "DELETE appointments
                FROM appointments INNER JOIN program on  appointments.id_program = program.id
                where appointments.id_program = (?) and appointments.id_user = (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->id_program, $this->id_user]);
    }
    function cancel_appointment()
    {
        if($this->is_id_program_valid())
        {
            $this->cancel_appointment_query();
            $this->modify_availability(True);
        }
    }
}