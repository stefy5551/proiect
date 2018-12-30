<?php
namespace App;

class Config
{
    const ENV = "dev";
    CONST DB = [
        "host" => "localhost",
        "port" => 3306,
        "driver" => "mysql",
        "dbname" => "database",
        "charset" => "utf8mb4",
        "user" => "root",
        "pass" => "",
    ];
}
