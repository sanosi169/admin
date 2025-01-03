<!DOCTYPE html>
<html lang="en">
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'heade.php';
require_once 'database.php';
require_once 'users.php';

?>
<body>
    <?php 

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    $database= new Database();
    $db=$database->getConnection();

    $user=new User(''.'','','','','');
    $users=$user->show($id);
    
    if ($users) {
        echo '
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Profile Image</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>' . htmlspecialchars($users['id']) . '</td>
                        <td>' . htmlspecialchars($users['name']) . '</td>
                        <td>' . htmlspecialchars($users['email']) . '</td>
                        <td><img src="images/' . htmlspecialchars($users['image']) . '" alt="Profile Image" width="50" height="50"></td>
                    </tr>
                </tbody>
            </table>
        ';
    } else {
        echo "Role not found!";
    }
}
    
  
    
    
    
    ?>
    
</body>
</html>