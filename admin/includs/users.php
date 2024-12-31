<?php
require_once 'database.php';
class User {
    private $name;
    private $email;
    private $password;
    private $role_id;
    private $image;

    
    public function __construct($name, $email, $password,$image) {
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT); 
        $this->image=$image;
    }

    public function getRole() {
        $query = "SELECT * FROM roles WHERE id = :role_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':role_id', $this->role_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save() {
        $query = "INSERT INTO users (name, email, role_id,image) VALUES (:name, :email, :role_id,:image)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':role_id', $this->role_id);
        $stmt->bindParam(':image', $this->image);

        $stmt->execute();
        $this->id = $this->db->lastInsertId(); 
    }

    public static function getAll($db) {
        $query = "SELECT * FROM users";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($db, $id) {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE users SET name = :name, email = :email, role_id = :role_id WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':role_id', $this->role_id);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }




}