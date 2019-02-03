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
#@TODO: 3. de scos campuri de peste tot
#@TODO: 4. de scos tabelele : hour and day
#@TODO: 5. de rezolvat update-u ala la delete(de la admin parca)
#@TODO: 6. de scos membrii din clasele Model
#@TODO: 7. de folosit Model
#@TODO: 8. daca ma loghez cu user si deschid o alta fereastra sa nu pot accesa decat user !!
class AdminModel extends Model
{
    protected $table = "users";

    private $username;
    private $password;
    private $email;
    private $name;
    private $pdo;

    private $user_id;

    public function __CONSTRUCT(string $username, string $password, string $email, string $name, $user_id)
    {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->name = $name;
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
    public function delete_user() : void
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
    public function can_be_doctor() : bool # he should not have any appointment to any doctor
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
    public function make_doctor() : void
    {
        if(!$this->can_be_doctor())
            return;

        $query = "UPDATE users SET is_doctor = 1 WHERE id = (?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$this->user_id]);
    }

    public function get_all_users()
    {
        $query = "SELECT * from $this->table";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}