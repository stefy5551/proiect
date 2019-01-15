<?php
namespace App\Models;
use Framework\Model;

class UserModel extends Model
{
//we have to set specify the corresponding model for the table
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

    function is_email_used()
    {
        $sql = "SELECT * FROM users WHERE email = (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->email]);
        $result = $stmt->fetch();
        if ($result)
        {
            return TRUE;
        }
        return FALSE;
    }
    function is_username_used()
{
    $sql = "SELECT * FROM users WHERE username = (?)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$this->username]);
    $result = $stmt->fetch();
    if ($result)
    {
        return TRUE;
    }
    return FALSE;
}
    function add_user()
    {
        if (!$this->is_email_used() and !$this->is_username_used()) {
            $sql = "INSERT INTO `users`(email, password, username, name) VALUES(?, ?, ?, ?)";
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$this->email, $hashedPassword, $this->username, $this->name]);

            $sql = "SELECT * FROM users WHERE username = (?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$this->username]);
            $result = $stmt->fetch();

            if ($result)
                $this->initiate_session($result);

            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    function get_all_doctors()
    {
        $query = "SELECT * from $this->table where is_doctor = 1";
        return $this->get_items($query);
    }
    function get_all_specializations()
    {
        $query = "SELECT specialization from $this->table where is_doctor = 1 group by Specialization";
        return $this->get_items($query);
    }
    function get_all_appointments()
    {
        $query = "SELECT days.day, hours.start_hour, users.*, program.id FROM users
                  INNER JOIN program on users.id = program.id_medic
                  INNER JOIN appointments on appointments.id_program = program.id
                  INNER JOIN days on days.id = program.id_day
                  INNER JOIN hours on hours.id = program.id_hour where appointments.id_user = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$_SESSION["id"]]);
        return $stmt->fetchAll();
    }
    function get_program()
    {
        $query = "SELECT days.day, hours.start_hour, users.*, program.id FROM users
                  INNER JOIN program on users.id = program.id_medic
                  INNER JOIN days on days.id = program.id_day
                  INNER JOIN hours on hours.id = program.id_hour where program.available = 1";
        return $this->get_items($query);
    }
    private function get_items(string $query)
    {
        $db = $this->newDbCon();
        $stmt = $db->query($query);
        return $stmt->fetchAll();
    }

}
