<!DOCTYPE html>
<html lang="en">
<?php
require_once 'heade.php';
require_once 'database.php';
require_once 'file.php';
?>
<body>
    <?php
    $database = new Database();
    $db = $database->getConnection();
    
    $file = new File($db);
    $files = $file->getAllFiles();

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        if ($file->delete($id)) {
            echo "File deleted successfully.";
        } else {
            echo "Failed to delete file.";
        }
    }
    ?>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Show</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($files as $index => $fileData) {
                echo '
                <tr>
                    <th scope="row">' . ($index + 1) . '</th>
                    <td>' . htmlspecialchars($fileData['file_name']) . '</td>
                    <td><a href="uploads/' . htmlspecialchars($fileData['file_name']) . '" target="_blank">View</a></td>
                    <td><a href="?delete=' . $fileData['id'] . '" onclick="return confirm(\'Are you sure?\')">Delete</a></td>
                </tr>
                ';
            }
            ?>
        </tbody>
    </table>
</body>
</html>
