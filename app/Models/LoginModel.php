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

    public function __CONSTRUCT(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->pdo = $this->newDbCon();
    }

    public function initiate_session($result) : void
    {
        $_SESSION["id"] = $result->id;
        $_SESSION["name"] = $result->name;
        $_SESSION["username"] = $result->username;
        $_SESSION["email"] = $result->email;
        $_SESSION["is_doctor"] = $result->is_doctor;
        $_SESSION["specialization"] = $result->specialization;
    }

    public function is_user_correct(): bool
    {
        $result = $this->get($this->username);
        
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
    public function is_user_doctor() : bool
    {
        $result = $this->get($this->username);

        if ($result)
        {
            if( $result->is_doctor)
                return True;
        }
        return FALSE;
    }
    public function is_user_admin() : bool
    {
        $result = $this->get($this->username);

        if ($result)
        {
            if( $result->is_admin)
                return True;
        }
        return FALSE;
    }
}