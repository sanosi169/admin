<!DOCTYPE html>
<html lang="en">
<?php    
// ini_set('display_errors', 1);
// error_reporting(E_ALL); 
require 'heade.php'; // Assuming header includes necessary CSS and JS files
require_once 'database.php'; // For database connection
 require_once 'users.php'; // Including the User class

?>

<body>
    <?php 
    // Database connection setup
    $database = new Database();
    $db = $database->getConnection();

    // Fetch roles from database
    $query = "SELECT * FROM roles";  // Modify table and columns based on your database
    $stmt = $db->prepare($query);
    $stmt->execute();
    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Handle form submission
    if (isset($_POST['submit'])) {
        // Get form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Password hashing
        $image = $_FILES['image']['name'];  // Get the file name of the uploaded image
        $role_id = $_POST['role_id'];

        $targetDirectory = "images/";
        $targetFile = $targetDirectory . basename($image);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES['image']['size'] > 2000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $user = new User($db);
                if ($user->create($name, $email, $password, $image, $role_id)) {
                    echo "User created successfully!";
                } else {
                    echo "User not created. Please try again.";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    ?>

    <form method="POST" enctype="multipart/form-data" action="#">  <!-- Added enctype for file upload -->
        <h2>Create User</h2>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
        </div>

        <div class="mb-3">
            <label for="exampleInputName" class="form-label">Name</label>
            <input type="text" class="form-control" id="exampleInputName" name="name" required>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label">Profile Image</label>
            <input class="form-control" type="file" id="formFile" name="image" required>
        </div>

        <div class="mb-3">
            <label for="roleId" class="form-label">Role</label>
            <select class="form-control" id="roleId" name="role_id" required>
                <option value="">Select Role</option>
                <?php 
                // Display roles in the dropdown
                foreach ($roles as $role) {
                    echo "<option value='{$role['id']}'>{$role['name']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
