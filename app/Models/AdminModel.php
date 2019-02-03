<?php
/**
 * Created by PhpStorm.
 * User: Sted
 * Date: 1/12/2019
 * Time: 2:10 PM
 */

namespace App\Models;

use Framework\Model;
#@TODO: 8. daca ma loghez cu user si deschid o alta fereastra sa nu pot accesa decat user !!
#@TODO: 9. mesaje eroare
class AdminModel extends Model
{
    protected $table = "users";
    private $pdo;

    public function __CONSTRUCT()
    {
        $this->pdo = $this->newDbCon();
    }
    
    private function is_user_doctor(int $user_id) : bool
    {
        $sql = "SELECT is_doctor FROM users WHERE id = (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);
        $result = $stmt->fetch();

        if ($result)
        {
            if($result->is_doctor)
                return True;
        }
        return FALSE;
    }
    public function delete_user(int $user_id) : void
    {

        if($this->is_user_doctor($user_id))
        {
            $query = "DELETE appointments from appointments
                      INNER JOIN program on program.id = appointments.id_program WHERE program.id_medic = (?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$user_id]);

            $query = "DELETE from program WHERE id_medic = (?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$user_id]);
        }
        else
        {
            $query = "UPDATE program as pr
                      INNER JOIN appointments as app
                      on pr.id = app.id_program
                      SET pr.available = 1
                      where app.id_user = (?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$user_id]);

            $query = "DELETE from appointments WHERE appointments.id_user = (?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$user_id]);
        }

        $query = "DELETE from users WHERE id = (?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$user_id]);
    }

    public function get_all_users()
    {
        $query = "SELECT * from $this->table";
        return $this->get_all_query($query);
    }
}