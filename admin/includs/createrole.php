<!DOCTYPE html>
<html lang="en">
<?php     
require 'heade.php';
require 'database.php';  
require 'role.php';  
?>

<body>
<div class="container mt-5">
<?php      
$database = new Database();  
$db = $database->getConnection(); 

if (isset($_POST['submit'])) {
    $name = $_POST['name'];  
    $role = new Role($db);  
    
    if ($role->create($name)) {
        echo "<div class='alert alert-success'>Role added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error adding role.</div>";
    }
}

?>

<form method="POST" action='#'>
    <div class="mb-3">
        <label for="roleName" class="form-label">Role Name</label>
        <input type="text" class="form-control" id="roleName" name="name" required>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>
