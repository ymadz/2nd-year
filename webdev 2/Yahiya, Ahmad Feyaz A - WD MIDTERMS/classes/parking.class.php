<?php
require_once "database.class.php";

class Parking extends Database {
    public $vehicle_plate;
    public $parking_slot_id;
    public $remarks;
    public $status;

    protected $db;

    function __construct() {
        $this->db = new Database;
    }

    public function parkVehicle() {
        $sql = "INSERT INTO parking_transactions (vehicle_plate, entry_time, parking_slot_id, remarks, status)
                VALUES (:vehicle_plate, NOW(), :parking_slot_id, :remarks, 'Parked')";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(":vehicle_plate", $this->vehicle_plate);
        $stmt->bindParam(":parking_slot_id", $this->parking_slot_id);
        $stmt->bindParam(":remarks", $this->remarks);

        if ($stmt->execute()) {
            $this->markSlotUnavailable($this->parking_slot_id);
            return true;
        } else {
            return false;
        }
    }

    public function markSlotUnavailable($slot_id) {
        $sql = "UPDATE parking_slots SET is_available = FALSE WHERE id = :slot_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(":slot_id", $slot_id);
        return $stmt->execute();
    }

    public function getAvailableSlots() {
        $sql = "SELECT id, slot_number FROM parking_slots WHERE is_available = 1";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function viewParkingTransactions() {
        $sql = "SELECT t.*, s.slot_number 
                FROM parking_transactions t
                JOIN parking_slots s ON t.parking_slot_id = s.id
                ORDER BY t.entry_time DESC";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchParkingTransactions($vehicle_plate) {
        $sql = "SELECT t.*, s.slot_number 
                FROM parking_transactions t
                JOIN parking_slots s ON t.parking_slot_id = s.id
                WHERE t.vehicle_plate LIKE :vehicle_plate
                ORDER BY t.entry_time DESC";
        $stmt = $this->db->connect()->prepare($sql);
        $vehicle_plate = "%" . $vehicle_plate . "%";
        $stmt->bindParam(":vehicle_plate", $vehicle_plate);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function exitVehicle($transaction_id) {
        $sql = "UPDATE parking_transactions 
                SET exit_time = NOW(), status = 'Exited' 
                WHERE id = :transaction_id AND status = 'Parked'";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(":transaction_id", $transaction_id);

        if ($stmt->execute()) {
            $transaction = $this->fetchTransaction($transaction_id);
            if ($transaction) {
                $this->markSlotAvailable($transaction['parking_slot_id']);
                return true;
            }
        }
        return false;
    }

    public function markSlotAvailable($slot_id) {
        $sql = "UPDATE parking_slots SET is_available = TRUE WHERE id = :slot_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(":slot_id", $slot_id);
        return $stmt->execute();
    }

    public function fetchTransaction($transaction_id) {
        $sql = "SELECT * FROM parking_transactions WHERE id = :transaction_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(":transaction_id", $transaction_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
