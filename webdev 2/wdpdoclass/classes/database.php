<?php

class Database {
    private $host = "localhost";
    private $dbname = "tutorialdb";
    private $username = "root";
    private $password = "";
     public $conn;

    function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->host; dbname=$this->dbname", "$this->username", "$this->password");
        } catch (PDOException $e) {
            echo "connection failed: " . $e->getMessage();
        }

        if($this->conn) {
            echo "successfully connected";
        }
    }
}