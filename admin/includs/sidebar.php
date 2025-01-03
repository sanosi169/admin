<!DOCTYPE html>
<html lang="en">
<?php require 'heade.php'; ?>

<head>
    
</head>

<body>
    
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">AdminHub</span>
        </a>
        <?php
session_start();

if (isset($_SESSION['user'])) {
    $userName = htmlspecialchars($_SESSION['user']['name']); // جلب اسم المستخدم
    $userImage = "uploads/" .htmlspecialchars( $_SESSION['user']['image']); // جلب رابط الصورة
} else {
    header('Location: login.php'); 
    exit;
}
if(isset($_POST["logout"])){
    session_unset();
    session_destroy();
    header('Location: login.php');

}

?>
<div class="user-info">
        <h1>مرحباً، <?php echo $userName; ?></h1>
    </div>
     
        <ul class="side-menu top">
            <li class="active">
                <a href="#">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">My Store</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text" onclick="showfiles()">files</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text" onclick="showuser()">Message</span>
                </a>
            </li>
            <li>
                <a href="#" id="load-user-form">
                    <i class='bx bxs-group'></i>
                    <span class="text">User</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="text" onclick="showroles()">roles</span>
                </a>
            </li>
            <li>
            <form method="POST" style="display: inline;">
    <button type="submit" name="logout" value="1" style="border: none; background: none; color: inherit; font: inherit; cursor: pointer;">
        <i class='bx bxs-log-out-circle'></i>
        <span class="text">Logout</span>
    </button>
</form>
</a>
            </li>
        </ul>
    </section>

    <section id="content">
        <nav>
            <!-- Navigation bar content -->
        </nav>
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Home</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- قسم ديناميكي -->
            <div id="dynamic-content">
                <p>Loading...</p>
            </div>
        </main>
    </section>
    <script src="assests/js/script.js"></script>
    <script src="assests/js/ajax.js"></script>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    
   
    

</body>

</html>