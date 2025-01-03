<?php
require_once 'database.php';

class User {
    private $name;
    private $email;
    private $password;
    private $image;
    private $role_id;
    private $db;

    public function __construct($name, $email, $password, $image, $role_id) {
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT); // Hash the password
        $this->image = $image;
        $this->role_id = $role_id;
        $this->db = new Database();
    }

    // Validate user input
    public function validate() {
        if (empty($this->name) || empty($this->email) || empty($this->password)) {
            return "Name, Email, and Password are required.";
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format.";
        }

        return true;
    }

    // Handle image upload
    public function uploadImage() {
        if ($this->image['error'] != 0) {
            return "Error uploading image.";
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = pathinfo($this->image['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            return "Invalid image file type.";
        }

        $imageName = time() . '_' . basename($this->image['name']);
        $targetDirectory = 'images/';
        $targetFile = $targetDirectory . $imageName;

        if (move_uploaded_file($this->image['tmp_name'], $targetFile)) {
            return $imageName; // return image name if upload is successful
        } else {
            return "Failed to upload image.";
        }
    }

    // Save user to the database
    public function save() {
        $validation = $this->validate();
        if ($validation !== true) {
            return $validation;
        }

        // Upload the image and handle errors
        $imageName = $this->uploadImage();
        if ($imageName !== false) {
            $this->image = $imageName;
        } else {
            return $imageName;
        }

        $sql = "INSERT INTO users (name, email, password, image, role_id) 
                VALUES (:name, :email, :password, :image, :role_id)";
        
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':role_id', $this->role_id);

        if ($stmt->execute()) {
            return "User successfully registered!";
        } else {
            return "Error registering user.";
        }
    }
    public function index(){
        $sql="SELECT * FROM users ";
        $stmt=$this->db->getConnection()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;



    }

    public function delete($id){
        $sql="DELETE FROM users WHERE id=:id";
        $stmt=$this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':id',$id);
        if($stmt->execute()){
            return "User deleted successfully";
            }else{
                return "Error deleting user";
            }


    }

    public function show($id) {
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";  // Query to select user by ID
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Bind the parameter to prevent SQL injection
        $stmt->execute();
        
        // Fetch the result as an associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return $result; 
        } else {
            return null; 
        }
    }


}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User($_POST['name'], $_POST['email'], $_POST['password'], $_FILES['image'], $_POST['role_id']);
    $result = $user->save();
    echo $result;
}

   
?>