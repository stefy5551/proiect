<?php
/**
 * Created by PhpStorm.
 * User: Sted
 * Date: 1/12/2019
 * Time: 2:10 PM
 */

namespace App\Models;

use Framework\Model;
#@TODO: 1. cand fac un doctor sa i bag specializarea
#@TODO: 2. cand vreau sa adaug o ora libera sa pot adauga in aceeasi ora cu alta ora libera de la alt doctor
class AdminModel extends Model
{
    protected $table = "users";

    private $username;
    private $password;
    private $email;
    private $name;
    private $pdo;

    private $user_id;

    function __CONSTRUCT(string $username, string $password, string $email, string $name, $user_id)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->name = $name;
        $this->pdo = $this->newDbCon();
        $this->user_id = $user_id;
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
    private function is_user_doctor() : bool
    {
        $sql = "SELECT is_doctor FROM users WHERE id = (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->user_id]);
        $result = $stmt->fetch();
        $_SESSION["name"] = $result;
        if ($result)
        {
            if($result->is_doctor)
                return True;
        }
        return FALSE;
    }
    function delete_user()
    {

        if($this->is_user_doctor())
        {
            $query = "DELETE appointments from appointments
                      INNER JOIN program on program.id = appointments.id_program WHERE program.id_medic = (?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$this->user_id]);

            $query = "DELETE from program WHERE id_medic = (?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$this->user_id]);
        }
        else
        {
            # NOT WORKING
            #  Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that
            # corresponds to your MariaDB server version for the right syntax to use near 'INNER JOIN appointments on
            # program.id = appointments.program_id' at line 2 in
            # D:\Facultate\XAMPP\htdocs\proiect\app\Models\AdminModel.php on line 82 ????????????

            $query = "UPDATE program SET available = true
                      INNER JOIN appointments on program.id = appointments.program_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();

            $query = "DELETE from appointments WHERE program.id_user = (?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$this->user_id]);

            $_SESSION["name"] = "not doc";
        }

        $query = "DELETE from users WHERE id = (?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$this->user_id]);
    }
    function can_be_doctor() : bool # he should not have any appointment to any doctor
    {
        $query = "SELECT * from program
                  INNER JOIN appointments on appointments.id_program = program.id where appointments.id_user = (?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$this->user_id]);
        $result = $stmt->fetch();
        if($result)
            return false;
        return true;
    }
    function make_doctor()
    {
        if(!$this->can_be_doctor())
            return;

        $query = "UPDATE users SET is_doctor = 1 WHERE id = (?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$this->user_id]);
    }

    function get_all_users()
    {
        $query = "SELECT * from $this->table";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}