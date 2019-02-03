<?php
namespace App\Models;
use Framework\Model;
use Framework\UsersModel;

class UserModel extends UsersModel
{
    protected $table = "users";

    private $pdo;

    public function __CONSTRUCT(string $username)
    {
        $this->username = $username;
        $this->get_user();
        $this->pdo = $this->newDbCon();
    }
    public function initiate_session($result) : void
    {
        $_SESSION["id"] = $result->id;
        $_SESSION["name"] = $result->name;
        $_SESSION["username"]=$result->username;
        $_SESSION["email"]=$result->email;
        $_SESSION["is_doctor"]=$result->is_doctor;
        $_SESSION["specialization"]=$result->specialization;
    }

    public function is_email_used() : bool
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
    public function is_username_used() : bool
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
    public function add_user() : bool
    {
        if (!$this->is_email_used() and !$this->is_username_used()) {
            $sql = "INSERT INTO `users`(email, password, username, name, specialization, is_doctor) 
                    VALUES(?, ?, ?, ?, ?, ?)";
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$this->email, $hashedPassword, $this->username, $this->name, $this->specialization,
                            $this->is_doctor]);

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
    public function get_all_doctors()
    {
        $query = "SELECT * from $this->table where is_doctor = 1";
        return $this->get_items($query);
    }
    public function get_all_specializations()
    {
        $query = "SELECT specialization from $this->table where is_doctor = 1 group by Specialization";
        return $this->get_items($query);
    }
    public function get_all_appointments()
    {
        $query = "SELECT program.day, program.start_hour, users.*, program.id FROM users
                  INNER JOIN program on users.id = program.id_medic
                  INNER JOIN appointments on appointments.id_program = program.id
                  where appointments.id_user = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$_SESSION["id"]]);
        return $stmt->fetchAll();
    }
    public function get_program()
    {
        $query = "SELECT program.day, program.start_hour, users.*, program.id FROM users
                  INNER JOIN program on users.id = program.id_medic
                  where program.available = 1";
        return $this->get_items($query);
    }
    private function get_items(string $query)
    {
        $db = $this->newDbCon();
        $stmt = $db->query($query);
        return $stmt->fetchAll();
    }

}
