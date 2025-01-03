

<!DOCTYPE html>
<html lang="en">
<?php 
require_once 'heade.php';
$ws=require 'database.php';
var_dump($ws);
require_once 'file.php';

?>
<body>
<?php

$database = new Database();
$db = $database->getConnection();

$file = new File($db);

if (isset($_POST['submit'])) {
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $targetDirectory = 'uploads/';

    if (move_uploaded_file($file_tmp, $targetDirectory . $file_name)) {
        $file->create($file_name);
        echo "File uploaded and saved successfully.";
    } else {
        echo "Failed to upload file.";
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($file->delete($id)) {
        echo "File deleted successfully.";
    } else {
        echo "Failed to delete file.";
    }
}

$files = $file->getAllFiles();
?>
    <h1>Upload File</h1>
    <form action="#" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
  <label for="formFile" class="form-label">Default file input example</label>
  <input class="form-control" type="file" id="formFile" name="file" required>
</div>
        <!-- <input type="file" name="file" required> -->
        <button type="submit" class="btn btn-primary" name="submit">Upload</button>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>
