<?php
namespace App\Models;
use Framework\Model;

class LoginModel extends Model
{
    private $id;
    private $username;
    private $password;
    private $email;
    private $is_doctor;
    private $pdo;

    function __CONSTRUCT(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
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

    function is_user_correct(): bool
    {
        $sql = "SELECT * FROM users WHERE username = (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->username]);
        $result = $stmt->fetch();

        if ($result)
        {
            if (password_verify($this->password, $result->password))
            {
                $this->initiate_session($result);
                return TRUE;
            }
        }
        return FALSE;
    }
    function is_user_doctor() : bool
    {
        $sql = "SELECT is_doctor FROM users WHERE username = (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->username]);
        $result = $stmt->fetch();

        if ($result)
        {
            if( $result->is_doctor)
                return True;
        }
        return FALSE;
    }
    function is_user_admin() : bool
    {
        $sql = "SELECT is_admin FROM users WHERE username = (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->username]);
        $result = $stmt->fetch();

        if ($result)
        {
            if( $result->is_admin)
                return True;
        }
        return FALSE;
    }
}