<?php
class Database{
static private $userName="root";
static private $password="0724886404Was";
static private $database="note_app";
static private $host="localhost";
static private $port="3306";

static private $connection;
private static function getConnection()
    {
        if (Database::$connection == null) {
            Database::$connection = new mysqli(Database::$host, Database::$userName, Database::$password, Database::$database, Database::$port);
        }
        return Database::$connection;
    }

    public static function getPrepareStatement($q)
    {
        return Database::getConnection()->prepare($q);
    }


}

?>