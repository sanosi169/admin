<!DOCTYPE html>
<html lang="en">
<?php 
require_once 'heade.php'; 
require_once 'database.php'; 
require_once 'role.php'; 
?>
<body>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $database = new Database();  
    $db = $database->getConnection();  
    $role = new Role($db);
    
    $roleDetails = $role->show($id);  // تمرير الـ id للحصول على دور واحد

    if ($roleDetails) {
        // عرض البيانات داخل جدول
        echo '<table class="table table-bordered">';
        echo '<thead><tr><th>ID</th><th>Name</th></tr></thead>';
        echo '<tbody>';
        echo '<tr>';
        echo '<td>' . $roleDetails['id'] . '</td>';
        echo '<td>' . $roleDetails['name'] . '</td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
    } else {
        echo "Role not found!";
    }
} else {
    echo "No role ID provided.";
}
?>
</body>
</html>
