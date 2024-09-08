<?php
    require_once "database.php";

    class Student extends Database {
        private $studentID;
        private $lastName;
        private $firstName;
        private $gender;
        protected $db;

        
        function __construct() {
            $this->db = new Database;
            $this->db->connect();
        }

        function getName() {
            return "$this->lastName, $this->firstName";
        }

        function setName($lastName, $firstName) {
            $this->lastName = $lastName;
            $this->firstName = $firstName;
        }

        function getData() {
            if ($this->db->conn) {
                $query = "SELECT * FROM students";
                $statement = $this->db->conn->prepare($query);
                $statement->execute();
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            } else {
                echo "Database connection not established.";
                return false;
            }
        }
    }