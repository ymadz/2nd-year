<?php
class Books {
    public $title;
    public $auth_name;
    public $genre;
    public $publisher;
    public $pub_date;
    public $edition;
    public $no_of_copies;
    public $format;
    public $age_group;
    public $rating;
    protected $conn;


    public function __construct() {
        require_once "database.php";
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function add() {
        $query = "INSERT INTO books (title, auth_name, genre, publisher, pub_date, edition, no_of_copies, format, age_group, rating) 
                  VALUES (:title, :auth_name, :genre, :publisher, :pub_date, :edition, :no_of_copies, :format, :age_group, :rating)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':auth_name', $this->auth_name);
        $stmt->bindParam(':genre', $this->genre);
        $stmt->bindParam(':publisher', $this->publisher);
        $stmt->bindParam(':pub_date', $this->pub_date);
        $stmt->bindParam(':edition', $this->edition);
        $stmt->bindParam(':no_of_copies', $this->no_of_copies);
        $stmt->bindParam(':format', $this->format);
        $stmt->bindParam(':age_group', $this->age_group);
        $stmt->bindParam(':rating', $this->rating);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getBooks() {
        $query = "SELECT * FROM books";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function clearDatabase() {
        try {
            $sql = "DELETE FROM books";  // This will delete all rows in the table
            $query = $this->conn->prepare($sql);
            if($query->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
