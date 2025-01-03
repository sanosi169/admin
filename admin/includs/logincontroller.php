<?php 
$ss=require_once 'database.php';

class Login{

    private $db;

    public function __construct($db) {

        $this->db=$db;
    }


    public function login($email, $password) {
        try {
            $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute(); 
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $role = $this->getRole($user['role_id']); 
                    $user['role'] = $role;
                    return [
                        'status' => true,
                        'message' => 'Login successful!',
                        'user' => $user,
                    ];
                } else {
                    return ['status' => false, 'message' => 'Invalid password.'];
                }
            } else {
                return ['status' => false, 'message' => 'User not found.'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }

    public function getRole($role_id) {
        $sql = "SELECT name FROM roles WHERE id = :role_id LIMIT 1"; 
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
        $stmt->execute();
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        return $role ? $role['name'] : 'User'; 
    }

    public function logout(){
        session_unset();
        session_destroy();
    }
}

    
  
