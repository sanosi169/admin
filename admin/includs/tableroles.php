<!DOCTYPE html>
<html lang="en">
<?php 
require_once 'heade.php'; 
require_once 'database.php'; 
require_once 'role.php'; 

?>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">show</th>
                <th scope="col">delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $database = new Database();  

            $db = $database->getConnection();  

            $role = new Role($db);
            $roles= $role->index(); 
            $index=0;
            
            foreach ($roles as $role) {
              echo '<tr>
                  <th scope="row">' .  ($index + 1)  . '</th>
                  <td>' . $role['name'] . '</td>
                  <td><a href="showrole.php?id=' . $role['id'] . '" class="btn btn-primary">Show</a></td>
                  <td>
                      <form action="delete_role.php" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this role?\');">
                          <input type="hidden" name="id" value="' . $role['id'] . '">
                          <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                  </td>
              </tr>';
              $index++;
          }
            ?>
             <div id="main-content" class="container allContent-section py-4">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <i class="fa fa-users  mb-2" style="font-size: 70px;"></i>
                            <h4 style="color:white;">Total Users</h4>
                            <h5 style="color:white;">
                                <?php
                                $sql = "SELECT * from roles ";
                                $result = $db->query($sql);
                                $count = 0;
                                // if ($result-> num_rows > 0){
                                //     while ($row=$result-> fetch_assoc()) {

                                //         $count=$count+1;
                                //     }
                                // }
                                echo $count;
                                ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </tbody>
    </table>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>