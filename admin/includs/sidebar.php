<!-- <!DOCTYPE html>
<html lang="en">
<?php    
require 'heade.php';
?>
<body>
<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">AdminHub</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">My Store</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Analytics</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Message</span>
				</a>
			</li>
			<li>
				<a href="createuser.php">
					<i class='bx bxs-group' ></i>
					<span class="text">user</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="#" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>

</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<?php require 'heade.php'; ?>
<head>
    <style>
        /* إخفاء المحتوى الافتراضي */
        #dynamic-content {
            display: none;
        }
    </style>
</head>
<body>
<section id="sidebar">
    <a href="#" class="brand">
        <i class='bx bxs-smile'></i>
        <span class="text">AdminHub</span>
    </a>
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
                <span class="text">Analytics</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bxs-message-dots'></i>
                <span class="text">Message</span>
            </a>
        </li>
        <li>
            <a href="#" id="load-user-form">
                <i class='bx bxs-group'></i>
                <span class="text">User</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="#">
                <i class='bx bxs-cog'></i>
                <span class="text">Settings</span>
            </a>
        </li>
        <li>
            <a href="#" class="logout">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Logout</span>
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

<script src="js/script.js"></script>
<script>
    // إظهار وإخفاء الفورم ديناميكيًا
    document.getElementById('load-user-form').addEventListener('click', function(e) {
        e.preventDefault(); // منع الانتقال الافتراضي
        const dynamicContent = document.getElementById('dynamic-content');

        if (dynamicContent.style.display === 'none' || dynamicContent.innerHTML.trim() === '') {
            // تحميل createuser.php عند الضغط
            fetch('createuser.php')
                .then(response => response.text())
                .then(data => {
                    dynamicContent.innerHTML = data; // عرض المحتوى
                    dynamicContent.style.display = 'block'; // إظهار القسم
                })
                .catch(error => {
                    dynamicContent.innerHTML = '<p>Error loading the form. Please try again.</p>';
                    dynamicContent.style.display = 'block';
                    console.error(error);
                });
        } else {
            // إخفاء القسم إذا كان ظاهرًا
            dynamicContent.style.display = 'none';
        }
    });
</script>
</body>
</html>
