<?php
namespace App\Models;
use Framework\Model;

class User extends Model
{
//we have to set specify the corresponding model for the table
    protected $table = "users";

    private $username;
    private $password;
    private $email;
    private $pdo;

    function __CONSTRUCT(string $username, string $password, string $email)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->pdo = $this->newDbCon();
    }

    public function get_name_by_id($id)
    {
        return $this->get($id);
    }

    function is_email_used()
    {
        $sql = "SELECT * FROM users WHERE email = (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->email]);
        $result = $stmt->fetch();
        if ($result) {
            return FALSE;
        }
        return TRUE;
    }
    function add_user()
    {
        if ($this->is_email_used()) {
            $sql = "INSERT INTO `users`(email, password, username) VALUES(?, ?, ?)";
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$this->email, $hashedPassword, $this->username]);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}
