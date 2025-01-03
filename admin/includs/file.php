<?php
require_once 'database.php';

class File {
    private $db;
    private $table = 'files'; 
    public function __construct($db) {
        $this->db = $db;
    }

    public function create($file_name) {
        $sql = "INSERT INTO {$this->table} (file_name) VALUES (:file_name)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':file_name', $file_name);

        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "SELECT file_name FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $file = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($file) {
            $file_path = 'uploads/' . $file['file_name'];
            if (file_exists($file_path)) {
                unlink($file_path); 
            }

            $sql = "DELETE FROM {$this->table} WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        }
        return false;
    }

    public function getAllFiles() {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
