<?php
// require_once 'database.php';
class Role {
        private $db;
        private $table = 'roles'; // اسم الجدول
    
        // منشئ الكلاس
        public function __construct($db) {
            $this->db = $db;
        }
    
        // دالة لإضافة دور إلى قاعدة البيانات
        public function create($name) {
            $sql = "INSERT INTO {$this->table} (name) VALUES (:name)";  // الاستعلام
            $stmt = $this->db->prepare($sql);  // تحضير الاستعلام
            $stmt->bindParam(':name', $name);  // ربط القيمة المدخلة
    
            return $stmt->execute();  // تنفيذ الاستعلام
        }
    

    public function read($id = null) {
        if ($id) {
            $sql = "SELECT * FROM {$this->table} WHERE id = :id";
            $stmt = $this->db->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
        } else {
            $sql = "SELECT * FROM {$this->table}";
            $stmt = $this->db->connection->prepare($sql);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $role_name) {
        $sql = "UPDATE {$this->table} SET role_name = :role_name WHERE id = :id";
        $stmt = $this->db->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':role_name', $role_name);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // الحصول على المستخدمين المرتبطين بالدور
    public function getUsers($role_id) {
        $sql = "SELECT * FROM user WHERE role_id = :role_id";
        $stmt = $this->db->connection->prepare($sql);
        $stmt->bindParam(':role_id', $role_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

