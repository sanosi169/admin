<?php
require_once 'database.php';
require_once 'role.php';

if (isset($_POST['id'])) {
    $roleId = $_POST['id']; 
    $database = new Database();
    $db = $database->getConnection();

    $role = new Role($db);

    if ($role->delete($roleId)) 
    
    {
        header('location:tableroles.php');

        echo "Role deleted successfully.";
    } else {
        echo "Error deleting role.";
    }
} else {
    echo "No role ID provided.";
}
?>
