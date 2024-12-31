<?php

class File {
    private $id;
    private $user_id;
    private $file_name;
    private $file_path;
    private $db;

    public function __construct($id = null, $user_id = null, $file_name = null, $file_path = null) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->file_name = $file_name;
        $this->file_path = $file_path;
    }

    public function setDatabaseConnection($db) {
        $this->db = $db;
    }

    // طريقة لحفظ الملف في قاعدة البيانات (Create)
    public function save() {
        $query = "INSERT INTO files (user_id, file_name, file_path) VALUES (:user_id, :file_name, :file_path)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':file_name', $this->file_name);
        $stmt->bindParam(':file_path', $this->file_path);
        $stmt->execute();
        $this->id = $this->db->lastInsertId(); // الحصول على الـ ID بعد الإدخال
    }

    // طريقة للحصول على جميع الملفات (Read)
    public static function getAllFiles($db) {
        $query = "SELECT * FROM files";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // طريقة للحصول على ملف حسب ID (Read)
    public static function getFileById($db, $id) {
        $query = "SELECT * FROM files WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // طريقة لتحديث ملف (Update)
    public function update() {
        $query = "UPDATE files SET user_id = :user_id, file_name = :file_name, file_path = :file_path WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':file_name', $this->file_name);
        $stmt->bindParam(':file_path', $this->file_path);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    // طريقة لحذف ملف (Delete)
    public function delete() {
        $query = "DELETE FROM files WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    // طريقة لتحميل الملف إلى المجلد المحدد
    public static function uploadFile($file, $target_dir) {
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (isset($file)) {
            if ($file["size"] > 5000000) { 
                echo "الملف كبير جدًا.";
                $uploadOk = 0;
            }

            // تحقق من نوع الملف
            if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "pdf") {
                echo "الملف يجب أن يكون صورة أو PDF.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "عذراً، لم يتم تحميل الملف.";
            } else {
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    echo "تم رفع الملف ". basename($file["name"]). " بنجاح.";
                    return $target_file;  
                } else {
                    echo "حدث خطأ أثناء تحميل الملف.";
                }
            }
        }
        return null;
    }
}
