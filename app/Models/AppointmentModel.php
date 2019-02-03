<?php
namespace App\Models;
use Framework\Model;

class AppointmentModel extends Model
{
    private $id_user;
    private $id_program;
    private $pdo;

    public function __CONSTRUCT($id_user, $id_program)
    {
        $this->id_user = $id_user;
        $this->id_program = $id_program;
        $this->pdo = $this->newDbCon();
    }
    private function is_id_user_valid() : bool
    {
        $query = "SELECT * from users WHERE id = (?)";
        return $this->is_item_valid($query, $this->id_user);
    }
    private function is_id_program_valid() : bool
    {
        $query = "SELECT * from program WHERE id = (?)";
        return $this->is_item_valid($query, $this->id_program);
    }
    private function is_program_available() : bool
    {
        $query = "SELECT available from program WHERE id = (?)";
        return $this->is_item_valid($query, $this->id_program);
    }
    private function is_user_available_at_hour() : bool
    {
        $query = "SELECT start_hour, `day` from program WHERE id = (?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$this->id_program]);
        $new_app = $stmt->fetch();


        $query = "SELECT start_hour, `day` from program 
                  INNER JOIN appointments on appointments.id_program = program.id
                  WHERE appointments.id_user = (?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$_SESSION["id"]]);
        $result = $stmt->fetchAll();

        foreach ($result as $value)
        {
            if ($value->day == $new_app->day and $value->start_hour == $new_app->start_hour)
                return FALSE;
        }
        return TRUE;
    }
    private function is_item_valid(string $query, $id) : bool
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

    public function add_appointment_query() : void
    {
        $sql = "INSERT INTO `appointments`(id_user, id_program) VALUES(?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->id_user, $this->id_program]);
    }

    public function modify_availability(bool $value) : void
    {
        $sql = "UPDATE program  SET Available = (?) WHERE id = (?);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$value, $this->id_program]);
    }
    public function make_appointment() : void
    {
        $this->is_user_available_at_hour();
        if($this->is_id_user_valid() and $this->is_id_program_valid() and $this->is_program_available()
            and $this->is_user_available_at_hour())
        {
            $this->add_appointment_query();
            $this->modify_availability(False);
        }
    }
    public function cancel_appointment_query() : void
    {
        $sql = "DELETE appointments
                FROM appointments INNER JOIN program on  appointments.id_program = program.id
                where appointments.id_program = (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->id_program]);
    }
    public function cancel_appointment() : void
    {
        if($this->is_id_program_valid())
        {
            $this->cancel_appointment_query();
            $this->modify_availability(True);
        }
    }
}