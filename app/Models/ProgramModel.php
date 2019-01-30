<?php

namespace App\Models;


use Framework\Model;

class ProgramModel extends Model
{
    private $id_hour;
    private $program_id;
    private $medic_id;
    private $hour;
    private $day;
    private $pdo;

    function __CONSTRUCT($medic_id, $program_id, $day, $hour)
    {
        $this->medic_id = $medic_id;
        $this->program_id = $program_id;
        $this->hour = $hour;
        $this->day = $day;
        $this->pdo = $this->newDbCon();
        if($hour != 0)
            $this->get_id_hour();
    }
    function is_item_free(string $query)
    {
        $sql = $query;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->day, $this->id_hour]);
        $result = $stmt->fetch();
        if ($result)
        {
            return FALSE;
        }
        return TRUE;
    }
    function is_time_taken() : bool
    {
        $query = "SELECT * from program WHERE id_day = (?) and id_hour = (?)";
        return !$this->is_item_free($query);
    }
    function get_id_hour()
    {
        $query = "SELECT * from hours where start_hour = (?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$this->hour]);
        $result = $stmt->fetch();

        $this->id_hour = $result->id;
    }
    function add_available_hour_query()
    {
        $sql = "INSERT INTO `program`(id_medic, id_day, id_hour, available) VALUES(?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->medic_id, $this->day, $this->id_hour, 1]);
    }
    function add_available_hour()
    {
        if($this->is_time_valid())
            $this->add_available_hour_query();

    }
    function is_time_valid() : bool
    {

        if ($this->day < 1 or $this->day > 7 or $this->hour < 6 or $this->hour > 22)
            return false;
        if($this->is_time_taken())
            return false;

        return true;
    }
    function remove_available_hour()
    {
        $query = "DELETE from program where id = (?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$this->program_id]);
//        $_SESSION["name"] = $this->program_id;
    }

}