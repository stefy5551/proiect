<?php

namespace App\Models;


use Framework\Model;

class ProgramModel extends Model
{
    private $program_id;
    private $medic_id;
    private $start_hour;
    private $day;
    private $pdo;

    public function __CONSTRUCT($medic_id, $program_id, $day, $start_hour)
    {
        $this->medic_id = $medic_id;
        $this->program_id = $program_id;
        $this->start_hour = $start_hour;
        $this->day = $day;
        $this->pdo = $this->newDbCon();
    }

    private function is_time_taken() : bool
    {
        $sql = "SELECT * from program WHERE day = (?) and start_hour = (?) and id_medic = (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->day, $this->start_hour, $this->medic_id]);
        $result = $stmt->fetch();
        if ($result)
        {
            return TRUE;
        }
        return FALSE;
    }

    private function add_available_hour_query() : void
    {
        $sql = "INSERT INTO `program`(id_medic, day, start_hour, available) VALUES(?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->medic_id, $this->day, $this->start_hour, 1]);
    }
    public function add_available_hour()
    {
        if(!$this->is_time_taken())
            $this->add_available_hour_query();
    }
    public function remove_available_hour() : void
    {
        $query = "DELETE from program where id = (?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$this->program_id]);
    }

}