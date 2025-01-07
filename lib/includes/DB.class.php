<?php

class D
{
    public static $conn = null;
    public static function getConnection()
    {
        if (self::$conn === null) 
        {
            
            $server_name = "localhost";
            $username = "root";
            $password = "rittish.g2023";
            $db_name = "electra_gen_db";

            $conn = new mysqli($server_name, $username, $password, $server_name);

            if ($conn->connect_error)
            {
                die("". $conn->connect_error);
            }else
            {
                self::$conn = $conn;
                return $conn;
            }
        }
        else
        {
            return self::$conn;
        }
    }
}