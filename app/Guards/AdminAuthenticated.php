<?php
namespace App\Guards;
use Framework\Guard;

class AdminAuthenticated implements Guard
{
    public function handle(array $params = null) : void
    {
        session_start();
        if(!isset($_SESSION['admin_logged']))
        {
            $this->reject();
        }
        session_abort();
    }
    public function reject() : void
    {
        header("Location: /login");
    }
}