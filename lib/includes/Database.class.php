<?php

class Database
{
    public static $conn = null;
    public static function getConnection()
    {
        if (Database::$conn == null)
        {
            $servername = "mysql.selfmade.ninja";
            $username   = "Project";
            $password   = "YesNit@2429";
            $dbname     = "ELECTRA_GEN";

            //Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) 
            {
                print("First conn");
                die("Connection failed: " . $conn->connect_error);     
            }
            else
            {
                print("Replace conn");
                Database::$conn = $conn;
                return Database::$conn;
            }
        }  
        else
        {
            return Database::$conn;
        } 
   }
}