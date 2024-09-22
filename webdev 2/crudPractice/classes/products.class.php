<?php
    require_once "database.class.php";

    class Products extends Database {
        public $id;
        public $name;
        public $category;
        public $price;
        public $availability;
        protected $db;

        function __construct(){
            $this->db = new Database;
        }

        function addProduct(){
            $sql = "insert into product(name, category, price, availability) values (:name, :category, :price, :availability);";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":category", $this->category);
            $stmt->bindParam(":price", $this->price);
            $stmt->bindParam(":availability", $this->availability);

            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        function showAllProduct($search = '', $category = '') {
            $query = "SELECT * FROM product WHERE 1";
        
            if (!empty($search)) {
                $query .= " AND name LIKE :search";
            }
        
            if (!empty($category)) {
                $query .= " AND category = :category";
            }
        
            $stmt = $this->db->connect()->prepare($query);
        
            if (!empty($search)) {
                $searchParam = '%' . $search . '%';
                $stmt->bindParam(':search', $searchParam);
            }
        
            if (!empty($category)) {
                $stmt->bindParam(':category', $category);
            }
        
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return [];
            }
        }
        

        function edit(){
            $sql = "update product set name = :name, category = :category, price = :price, availability = :availability where id = :id;";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":category", $this->category);
            $stmt->bindParam(":price", $this->price);
            $stmt->bindParam(":availability", $this->availability);
            $stmt->bindParam(":id", $this->id);

            return $stmt->execute();
        }

        function fetchRecord($recordID){
            $sql = "select * from product where id = :recordID;";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(":recordID", $recordID);
            $data=null;
            
            if($stmt->execute()){
                $data = $stmt->fetch();
            }
            return $data;
        }

        function delete($id){
            $sql = "delete from product where id = :id;";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(":id", $id);
            
            
            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }
    }
