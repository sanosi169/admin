<?php session_start();
       ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- ! font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- ! css file -->
    <link rel="stylesheet" href="assests/css/stylelog.css">
</head>
<body>
    <?php 
    session_start();
    include('User.php');  // Assuming the User class is in the same directory
    
    if (isseet($_POST==['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $user = new User($db, null, $email, $password);
        if ($user->login()) {
            header('Location: index.php');
            exit();
        } else {
            echo 'Invalid email or password.';
        }
    }
    
    ?>
    
    <div class="container">
        <h3>login</h3>
        <form action="" method='POST'>
            <div class="field">
                <i class="fa-solid fa-user"></i>
                <input type="email" placeholder="Email or Phone">
            </div>
            <div class="field">
                <i class="fa-solid fa-lock"></i>
                <input type="password" placeholder="Password">
            </div>
            <!-- <a href="#">Forgot Password?</a> -->
            <div class="loginCircle">
                <button class="fa-solid fa-check" name='login'></button>
                <!-- icons -->
                <i class="fa-brands fa-facebook-f"></i>
                <i class="fa-brands fa-github"></i>
                <i class="fa-brands fa-google"></i>
                <i class="fa-brands fa-microsoft"></i>
            </div>
        </form>
    </div>

</body>
</html>