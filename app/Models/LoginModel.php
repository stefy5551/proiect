<?php
namespace App\Models;
use Framework\Model;

class LoginModel extends Model
{
    private $username;
    private $password;
    private $pdo;

    function __CONSTRUCT(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->pdo = $this->newDbCon();
    }

    function initiate_session($result)
    {
        $_SESSION["username"] = $result->username;
    }

    function is_user_correct(): bool
    {
        $sql = "SELECT * FROM users WHERE username = (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->username]);
        $result = $stmt->fetch();
        session_start();
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
}