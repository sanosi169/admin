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
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Image</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $database = new Database();
      $db = $database->getConnection();


      $userModel = new User('','','','','');


      $users = $userModel->index(); 



      foreach ($users as $index => $user) {
        echo "
        <tr>
            <th scope='row'>" . ($index + 1) . "</th>
            <td>{$user['name']}</td>
            <td>{$user['email']}</td>
            <td>{$user['name']}</td>
            <td><img src='images/{$user['image']}' alt='Profile Image' width='50' height='50'></td>
            <td><a href='showuser.php?id=" . $user['id'] . "' class='btn btn-primary'>Show</a></td>
            <td>
                <form action='delete_user.php' method='POST' onsubmit='return confirm(\"Are you sure you want to delete this user?\");'>
                    <input type='hidden' name='id' value='" . $user['id'] . "'>
                    <button type='submit' class='btn btn-danger'>Delete</button>
                </form>
            </td>
        </tr>";
    }
    ?>
    

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>

</html>