<?php

class DatabaseManager{

    public $conn;

    public function __construct()
    {
        $this->conn = $this->getConnection();
    }

    //metodi

    public function getConnection(){

        $hostname = "localhost";
        $dbname = "fantaroyale";
        $username = "root";
        $passwd = "";

        try {
            $connection = new PDO('mysql:host='. $hostname . ';dbname='. $dbname, $username, $passwd);
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            http_response_code(500);
            die;
        }

        return $connection;

    }



}