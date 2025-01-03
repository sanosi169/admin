<!DOCTYPE html>
<html lang="en">
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once "heade.php";
require_once "database.php";
require_once "users.php";
?>
<body>
    <?php
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $database = new Database();
        $db = $database->getConnection();
        $user = new User('','','','','');
        
        // حذف المستخدم
        $result = $user->delete($id);

        if ($result) {
            // إعادة التوجيه بعد الحذف
            header('Location: userindex.php');
            exit; // تأكد من استخدام exit لتجنب تنفيذ الكود بعد التوجيه.
        } else {
            echo "Error deleting user.";
        }
    } else {
        echo "No user ID provided.";
    }
    ?>
</body>
</html>
