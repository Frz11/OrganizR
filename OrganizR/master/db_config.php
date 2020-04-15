<?php

class DB{
    public static $username = 'root';
    public static $password = 'toor';
    public static $db_name = 'OrganizR';
    public static $server = 'localhost';

    public static function initializeDb(){
        $conn = new mysqli(DB::$server,DB::$username,DB::$password,DB::$db_name);
        if($conn->connect_error){
            die("Connection failed:".$conn->connect_error);

        }
        return $conn;
    }

}

?>