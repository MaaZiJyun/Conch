<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.php');
}
include("../controller/connection.php");
$sql="select * from houses WHERE owner_id=".$_SESSION['id'];
$data=mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Conch | A Housing Rental Web</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
			integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
			integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
		</script>
		<link rel="stylesheet" href="../scss/index.css">
	</head>

	<body>

		<!-- broad section -->
		<div class="top-board jumbotron text-center">
			<div class="container">
				<h1>My Houses</h1>
				<p>Resize this responsive page to see the effect!</p>
				<!-- <form class="form-inline">
					<div class="input-group">
						<input type="text" class="form-control" size="50" placeholder="Any place you wanna explore?"
							required>
						<div class="input-group-btn">
							<button type="button" class="btn btn-dark">Search</button>
						</div>
					</div>
				</form> -->
			</div>
		</div>

		<!-- navbar section -->
		<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
		  <div class="container">
		    <a class="navbar-brand" href="../index.php">CONCH LOGO</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarScroll">
		      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
				<li><a href="../index.php" class="nav-link px-2 text-white">Home</a></li>
		      	<li><a href="../view/house-list-view.php" class="nav-link px-2 text-white">View Houses</a></li>
				<?php 
				if ($_SESSION['loggedin']) {
					if ($_SESSION['identity'] == 'owner') {
						echo '<li><a href="../view/my-house-view.php" class="nav-link px-2 text-white">My House</a></li>';
                        echo '<li><a href="../view/my-booking-view.php" class="nav-link px-2 text-white">My Booking</a></li>';
					} else {
						echo '<li><a href="../view/my-booking-view.php" class="nav-link px-2 text-white">My Booking</a></li>';
					}
				} 
				?>
		      </ul>
		      <div class="d-flex">
				<?php
				if ($_SESSION['loggedin']) {
					echo '<div class="btn-group">';
					echo '<button type="button" class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown"> Hello~ '.$_SESSION['name'].'</button>';
					echo '<div class="dropdown-menu">';
					echo '<a class="dropdown-item" href="../view/home-view.php">Profile</a>';
					echo '<a class="dropdown-item" href="../controller/logout.php">Sign-out</a>';
					echo '</div>';
					echo '</div>';
				} else {
					echo '<a href="../view/login-view.php" class="btn btn-outline-light me-2">Sign-in</a>';
					echo '<a href="../view/logon-view.php" class="btn btn-success">Sign-up</a>';
				}
				?>
		      </div>
		    </div>
		  </div>
		</nav>

		<!-- content -->
		<main>
			<div class="content">
                <div class="container">
					<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative d-d-grid">
						<a class="btn btn-outline-dark" href="../view/house-register-view.php">Add a new House</a>
					</div>
					<?php 
					while($result=mysqli_fetch_assoc($data)){
						echo '<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">';
						echo '<div class="col-sm-8 p-4 d-flex flex-column position-static">';
						echo '<h3 class="mb-0">'.$result['country'].'</strong> '.$result['city'].", ".$result['state'].'</h3>';
						echo '<div class="mb-1 text-muted">'.$result['address'].'</div>';
						echo '<p class="card-text mb-auto">'.$result['description'].'</p>';
						echo '<a href="../view/house-detail-view.php?id='.$result['id'].'" class="stretched-link">View More</a>';
						echo '</div>';
						echo '<div class="col-sm-4 d-none d-lg-block">';
						echo '<img width="100%" height="100%" src="../uploads/house-image'.$result['pics'].'"/>';
						echo '</div>';
						echo '</div>';
					}
					?>
				</div>
			</div>
		</main>

		<!-- footer -->
		<div class="footer container-fluid">
			<div class="container">
				<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
					<p class="col-md-4 mb-0 text-muted">&copy; 2022 Company, Inc</p>

					<a href="/"
						class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
						<svg class="bi me-2" width="40" height="32">
							<use xlink:href="#bootstrap" />
						</svg>
					</a>

					<ul class="nav col-md-4 justify-content-end">
						<li class="nav-item"><a href="../index.php" class="nav-link px-2 text-muted">Home</a></li>
						<li class="nav-item"><a href="../view/house-list-view.php" class="nav-link px-2 text-muted">View Houses</a></li>
						<?php 
						if ($_SESSION['loggedin']) {
							if ($_SESSION['identity'] == 'owner') {
								echo '<li class="nav-item"><a href="../view/my-house-view.php" class="nav-link px-2 text-muted">My House</a></li>';
                                echo '<li class="nav-item"><a href="../view/my-booking-view.php" class="nav-link px-2 text-muted">My Booking</a></li>';
							} else {
								echo '<li class="nav-item"><a href="../view/my-booking-view.php" class="nav-link px-2 text-muted">My Booking</a></li>';
							}
						} 
						?>
					</ul>
				</footer>
			</div>
		</div>

	</body>

</html>
