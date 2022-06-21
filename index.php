<?php
session_start();
if (isset($_SESSION['loggedin'])) {
	header('Location: ./view/home-view.php');
}
include("./controller/connection.php");
$query="select * from house LIMIT 4";
$data=mysqli_query($conn,$query);
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
		<link rel="stylesheet" href="./scss/index.css">
	</head>

	<body>

		<!-- broad section -->
		<div class="top-board jumbotron text-center">
			<div class="container">
				<h1>Conch</h1>
				<p>Resize this responsive page to see the effect!</p>
				<form class="form-inline">
					<div class="input-group">
						<input type="text" class="form-control" size="50" placeholder="Any place you wanna explore?"
							required>
						<div class="input-group-btn">
							<button type="button" class="btn btn-dark">Search</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<!-- navbar section -->
		<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
		  <div class="container">
		    <a class="navbar-brand" href="./index.php">CONCH LOGO</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarScroll">
		      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
				<li><a href="./index.php" class="nav-link px-2 text-white">Home</a></li>
		      	<li><a href="./view/house-list-view.php" class="nav-link px-2 text-white">View Houses</a></li>
				<?php 
				if ($_SESSION['loggedin']) {
					if ($_SESSION['identity'] == 'owner') {
						echo '<li><a href="#" class="nav-link px-2 text-white">My House</a></li>';
					} else {
						echo '<li><a href="#" class="nav-link px-2 text-white">My Booking</a></li>';
					}
				} 
				?>
		      </ul>
		      <div class="d-flex">
				<?php
				if (isset($_SESSION['loggedin'])) {
					echo '<div class="btn-group">';
					echo '<button type="button" class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown"> Hello~ '.$_SESSION['name'].'</button>';
					echo '<div class="dropdown-menu">';
					// echo '<a class="dropdown-item" href="#">Profile</a>';
					echo '<a class="dropdown-item" href="./controller/logout.php">Sign-out</a>';
					echo '</div>';
					echo '</div>';
				} else {
					echo '<a href="./view/login-view.php" class="btn btn-outline-light me-2">Sign-in</a>';
					echo '<a href="./view/logon-view.php" class="btn btn-success">Sign-up</a>';
				}
				?>
		      </div>
		    </div>
		  </div>
		</nav>

		<!-- content -->
		<main>
			<div class="content">

				<div class="intro-board p-5 mb-5 rounded-3">
					<div class="container py-5">
						<h1 class="display-5 fw-bold">What is Conch?</h1>
						<p class="col-md-8 fs-4">Conch helps each user meet their needs, they can rent here or rent the house to others. And the service here will be free.</p>
						<a href="./view/logon-view.php" class="btn btn-dark my-2">To Get a Conch Account for Free</a>
					</div>
				</div>

				<hr class="container">

				<div class="house-example container">
					<?php 
					$loopn = 0;
					while($result=mysqli_fetch_assoc($data)){
						if ($loopn < 1){
							echo '<div class="row">';
							echo '<div class="col-sm-3">';
							echo '<div class="card" style="width: 100%;">';
							echo '<img class="card-img-top" width="100%" src="data:pics/jpeg;base64,'.base64_encode( $result['pics'] ).'"/>';
							echo '<div class="card-body">';
							echo '<h5>'.$result['address'].'</h5>';
							echo '<p><strong>'.$result['country'].'</strong> '.$result['city'].", ".$result['state'].'</p>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							
						}elseif ($loopn < 4) {
							echo '<div class="col-sm-3">';
							echo '<div class="card" style="width: 100%;">';
							echo '<img class="card-img-top" width="100%" src="data:pics/jpeg;base64,'.base64_encode( $result['pics'] ).'"/>';
							echo '<div class="card-body">';
							echo '<h5>'.$result['address'].'</h5>';
							echo '<p><strong>'.$result['country'].'</strong> '.$result['city'].", ".$result['state'].'</p>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							
						}else {
							echo '<div class="col-sm-3">';
							echo '<div class="card" style="width: 100%;">';
							echo '<img class="card-img-top" width="100%" src="data:pics/jpeg;base64,'.base64_encode( $result['pics'] ).'"/>';
							echo '<div class="card-body">';
							echo '<h5>'.$result['address'].'</h5>';
							echo '<p><strong>'.$result['country'].'</strong> '.$result['city'].", ".$result['state'].'</p>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
						}
						$loopn += 1;
					}
					?>
				</div>
			</div>

			<section class="center-board py-5 text-center container-fluid mt-5 mb-5">
				<div class="container">
					<div class="row py-lg-5">
					<div class="col-lg-6 col-md-8 mx-auto">
						<h1 class="fw-light">Interesting in Conch?</h1>
						<p class="lead text-muted">Sign up for a free account and join our platform, we will provide you with what you need, whether you want to rent or want to rent your house to someone else.</p>
						<p>
						<a href="./view/logon-view.php" class="btn btn-dark my-2">Join Now</a>
						<a href="#" class="btn btn-outline-dark my-2">View more houses</a>
						</p>
					</div>
					</div>
				</div>
			</section>

			<div class="customer-profile container marketing">
				<div class="row text-center mb-5">
					<h3>Our Customer's Comments</h3>
				</div>
				<div class="row">
					<div class="col-lg-3 text-center">
						<img class="bd-placeholder-img rounded-circle mb-3" width="140" height="140" src="./assets/img/comment-profile/wan.jpg"></img>
						<h2 class="fw-normal">Kang Wan</h2>
						<p>It gave me more chooses, and I can have a better communication with landlord, I got a better house for the same price</p>
					</div>
					<div class="col-lg-3 text-center">
						<img class="bd-placeholder-img rounded-circle mb-3" width="140" height="140" src="./assets/img/comment-profile/wu.png"></img>
						<h2 class="fw-normal">Jingci Wu</h2>
						<p>This is the only software I use after many. I appreciate it very much.</p>
					</div>
					<div class="col-lg-3 text-center">
						<img class="bd-placeholder-img rounded-circle mb-3" width="140" height="140" src="./assets/img/comment-profile/wang.png"></img>
						<h2 class="fw-normal">Yida Wang</h2>
						<p>After experiencing the software, I think it is very beneficial for both tenants and landlords. </p>
					</div>
					<div class="col-lg-3 text-center">
						<img class="bd-placeholder-img rounded-circle mb-3" width="140" height="140" src="./assets/img/comment-profile/ma.jpg"></img>
						<h2 class="fw-normal">Zhiyuan Ma</h2>
						<p>Combining traditional industries with the internet is a great business innovation.</p>
					</div>
				</div>
			</div>

			<hr class="container">

			<div class="container">
				<div class="comment-box">
					<div class="row text-center mb-5" >
						<h3>Leave a Comment</h3>
					</div>
					<form>
						<div class="row mb-2">
							<div class="col">
								<label for="exampleFormControlInput1" class="form-label">Email address</label>
								<input type="email" class="form-comment form-control" id="exampleFormControlInput1" placeholder="name@example.com">
							</div>
							<div class="col">
								<label for="exampleFormControlInput1" class="form-label">Name</label>
								<input type="email" class="form-comment form-control" id="exampleFormControlInput1" placeholder="name">
							</div>
						</div>
						<div class="row mb-4">
							<div class="col">
								<label for="comment">Comments:</label>
								<textarea class="form-comment form-control" rows="5" id="comment" name="text"></textarea>
							</div>									
						</div>
						<div class="row">
							<div class="col d-grid">
								<a class="btn btn-dark btn-block">submit</a>
							</div>
						</div>
					</form>
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
						<li class="nav-item"><a href="./index.php" class="nav-link px-2 text-muted">Home</a></li>
						<li class="nav-item"><a href="./view/house-list-view.php" class="nav-link px-2 text-muted">View Houses</a></li>
						<?php 
						if (isset($_SESSION['loggedin'])) {
							if ($_SESSION['identity'] == 'owner') {
								echo '<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">My House</a></li>';
							} else {
								echo '<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">My Booking</a></li>';
							}
						} 
						?>
					</ul>
				</footer>
			</div>
		</div>

	</body>

</html>
