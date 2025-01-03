<?php
require_once 'database.php';
class Role {
        private $db;
        private $table = 'roles'; 
    
        public function __construct($db) {
            $this->db = $db;
        }
    
        public function create($name) {
            $sql = "INSERT INTO {$this->table} (name) VALUES (:name)";  
            $stmt = $this->db->prepare($sql);  
            $stmt->bindParam(':name', $name); 
    
            return $stmt->execute();  
        }

        public function show($id)
        
        {
            // var_dump($id);
            
            $sql = 'SELECT * FROM roles WHERE id = :id LIMIT 1'; // استعلام لاستخراج دور واحد بناءً على id
            $stmt = $this->db->prepare($sql);  // تحضير الاستعلام
            $stmt->bindParam(':id', $id);  // ربط المتغير id مع الاستعلام
            $stmt->execute();  // تنفيذ الاستعلام
            return $stmt->fetch(PDO::FETCH_ASSOC);  // جلب نتيجة واحدة (دور واحد) كـ مصفوفة مرتبطة
        }


                // public function index() {
                //     try {
                //         $sql = "SELECT * FROM {$this->table}";
                //         $stmt = $this->db->connection->prepare($sql);

                        
                //         $stmt->execute();
                
                //         // إرجاع النتائج كمصفوفة
                //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
                //     } catch (PDOException $e) {
                //         // التعامل مع الأخطاء عند فشل الاتصال أو الاستعلام
                //         echo "Error: " . $e->getMessage();
                //         return false; // أو يمكنك إعادة مصفوفة فارغة أو نتائج محددة بناءً على احتياجك
                //     }
                // }
                

                public function index() {
                    try {
                        $sql = "SELECT * FROM {$this->table}";
                        $stmt = $this->db->prepare($sql);
                
                        // تنفيذ الاستعلام
                        $stmt->execute();
                
                        // طباعة عدد الصفوف المتأثرة (للتأكد من أن هناك بيانات)
                        // echo "Rows affected: " . $stmt->rowCount() . "<br>";
                
                        // إرجاع النتائج كمصفوفة
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                        // طباعة النتائج
                        // echo "<pre>";
                        // print_r($results);
                        // echo "</pre>";
                
                        return $results;
                    } catch (PDOException $e) {
                        // طباعة الخطأ الكامل
                        echo "Error: " . $e->getMessage();
                        return false; 
                    }
                }

                public function delete($roleId){

                   $sql = "DELETE FROM {$this->table} WHERE id = :id"; 
                   $stmt = $this->db->prepare($sql);
                   $stmt->bindParam(':id', $roleId);  
                   return $stmt->execute();  

 


                }
                
    }
    

   

    

