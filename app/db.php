<?php

namespace App;

$dsn = "mysql:host=localhost;dbname=database;charset=utf8mb4";
$username="root";
$pass="";
$options = [];

try {
	$pdo = new PDO($dsn, $username, $pass, $options);
}
catch(PDOExceptio $e) {
    throw new PDOException($e -> getMessage(), $e -> getCode());
}