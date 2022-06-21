<?php
session_start();
$id = $_GET [ 'id' ];
// $query="select * from house where id = ".$id;
// $data=mysqli_query($conn,$query);
$strHouseController='../controller/house-controller.php';
$strOwnerController='../controller/owner-controller.php';

require_once $strHouseController;
require_once $strOwnerController;

$controllerH=new HouseController();
$controllerO=new OwnerController();

$result_house=$controllerH->detail($id);
$result_owner=$controllerO->detail($result_house['owner_id']);
// echo '<script> alert("'.$result["owner_id"].'");</script>';
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
		<link rel="stylesheet" href="../scss/house-detail-view.css">
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
						echo '<li><a href="#" class="nav-link px-2 text-white">My House</a></li>';
						echo '<li><a href="#" class="nav-link px-2 text-white">My Booking</a></li>';
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
					echo '<a class="dropdown-item" href="../controller/logout.php">Sign-out</a>';
					echo '</div>';
					echo '</div>';
				} else {
					echo '<a href="../view/login-view.html" class="btn btn-outline-light me-2">Sign-in</a>';
					echo '<a href="../view/logon-view.html" class="btn btn-success">Sign-up</a>';
				}
				?>
		      </div>
		    </div>
		  </div>
		</nav>

		<!-- content -->
		<main>
			<div class="content">
				<div class="container mt-5">
					<div class="row">
						<div class="basic-info-col col-sm-4 d-grid">
							<h3>About Owner</h3>
							<!-- <p>Some text about me in culpa qui officia deserunt mollit anim..</p> -->
							<ul class="nav nav-pills flex-column">
								<li class="nav-item">
									<p>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
											<path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
										</svg>
										<?php echo $result_owner['name'] ?>
									</p>
								</li>
								<li class="nav-item">
									<p>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pin-map-fill" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
											<path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
										</svg>
										<?php echo $result_owner['city'] ?>, <?php echo $result_owner['state'] ?>, <?php echo $result_owner['country'] ?>
									</p>
								</li>
								<li class="nav-item">
									<p>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
										</svg>
										<?php echo $result_owner['mobile_no'] ?>
									</p>
								</li>
								<li class="nav-item">
									<p>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
											<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
										</svg>
										<?php echo $result_owner['email'] ?>
									</p>
								</li>
							</ul>
							<!-- <div class="owner-profile">
								<img height="100%" width="100%" src="../assets/img/landscape.jpg">
							</div> -->
							<h3 class="mt-4">House Info</h3>
							<!-- <p>Lorem ipsum dolor sit ame.</p> -->
							<ul class="nav nav-pills flex-column">
								<li class="nav-item">
									<p>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
											fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
											<path
												d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z" />
											<path
												d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z" />
										</svg>
										<?php echo $result_house['no_of_rooms'] ?>
									</p>
								</li>
								<li class="nav-item">
									<p>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
											fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
											<path
												d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" />
										</svg>
										<?php echo $result_house['rate'] ?> per month
									</p>
								</li>
								<li class="nav-item">
									<p>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
											fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
											<path
												d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.501.501 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89L8 0ZM3.777 3h8.447L8 1 3.777 3ZM2 6v7h1V6H2Zm2 0v7h2.5V6H4Zm3.5 0v7h1V6h-1Zm2 0v7H12V6H9.5ZM13 6v7h1V6h-1Zm2-1V4H1v1h14Zm-.39 9H1.39l-.25 1h13.72l-.25-1Z" />
										</svg>
										<?php echo $result_house['country'] ?>
									</p>
								</li>
								<li class="nav-item">
									<p>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
											fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
											<path fill-rule="evenodd"
												d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z" />
											<path
												d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z" />
										</svg>
										<?php echo $result_house['city'] ?>, <?php echo $result_house['state'] ?>
									</p>
								</li>
							</ul>
							<!-- <hr class="d-sm-none"> -->
							<?php 
							if (isset($_SESSION['loggedin']) && $_SESSION['identity'] == 'tenant') {
								echo '<a href="../view/booking-register-view.php?h_id='.$result_house['id'].'&o_id='.$result_owner['o_id'].'&rate='.$result_house['rate'].'" style="height: fit-content;" class="btn btn-dark btn-block mt-2">Book Now!</a>';
							}elseif (isset($_SESSION['loggedin']) && $_SESSION['identity'] == 'owner') {
								# code...
							} else {
								echo '<a href="../view/logon-view.php" style="height: fit-content;" class="btn btn-dark btn-block mt-2">Log in and Book Now!</a>';
							}
							?>
						</div>
						<div class="house-intro-col col-sm-8 d-grid">
							<h3>
								<?php echo $result_house['address'] ?>
							</h3>
							<img class="mb-2" width="100%" src="<?php echo 'data:pics/jpeg;base64,'.base64_encode( $result_house['pics'] ); ?>">
							<p><?php echo $result_house['description'] ?></p>
						</div>
					</div>
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
						<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
						<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
						<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
						<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
						<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
					</ul>
				</footer>
			</div>
		</div>

	</body>

</html>
