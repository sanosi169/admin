<!DOCTYPE html>
<html lang="en">
<body>
	<?php 
	
	$userImage = "images/" . $_SESSION['user']['image'];

	?>
<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<!-- <a href="#" class="nav-link">Categories</a> -->
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
			<img src="<?php echo $userImage; ?>" alt="صورة المستخدم" style="width:100px; height:100px; border-radius:50%;">
			</a>
		</nav>
		<!-- NAVBAR -->
</body>
<script src="js/script.js"></script>

</html>