<?php

namespace App\Controllers;

    require_once "db.php";

    function testUsername($username): bool
    {
        $usernameValidator = true;

        if(!isset($username) || strlen($username) < 4)
        {
            $usernameValidator = false;
        }

        return $usernameValidator;
    }

    function testEmail($email): bool
    {
        $emailValidator = true;

        if(!isset($email) || strlen($email) < 10 || strpos('@', $email))
        {
            $emailValidator = false;
        }
        return $emailValidator;
    }

    function testPassword($password): bool
    {
        $passwordValidator = true;

        if(!isset($password) || strlen($password) < 6)
        {
            $passwordValidator = false;
        }

        return $passwordValidator;
    }


    function validateForm()
    {
        if(!testUsername($_POST["username"]))
        {
            echo "Invalid username  ";
        }

        if(!testEmail($_POST["email"]))
        {
            echo "Invalid email  ";
        }

        if(!testPassword($_POST["password"]))
        {
            echo "Invalid password  ";
        }
    }

    validateForm();

    function registerUser(string $username, $pass, $email, PDO $pdo): bool
    {
        $sql = "INSERT INTO users(email, password, username) VALUES(?, ?, ?)";
        $password = password_hash($pass, PASSWORD_DEFAULT);

        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([$email, $password, $username]);

        return true;
    }



    if(registerUser($_POST["username"], $_POST["password"], $_POST["email"], $pdo))
    {
        header("location: login.view.php");
    }

// tema : creare functie autentificare.
    // $result = $stmt->fetch(); -- ia datele din db
    // passowrd_verify($_post("password"), $pass_db)