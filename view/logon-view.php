<?php
session_start();
if (isset($_SESSION['loggedin'])) {
	header('Location: ./view/home-view.php');
}
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
		<link rel="stylesheet" href="../scss/login-view.css">
	</head>

	<body>

		<!-- broad section -->
		<div class="top-board jumbotron text-center">
			<div class="container">
				<h1>Register</h1>
				<p>Resize this responsive page to see the effect!</p>
			</div>
		</div>

		<!-- content -->
		<main>
			<div class="content">
				<div class="container">
					<div class="center login-card">
						<form name="logon" id="logon" action="../view/logon-view.html" method="post" onsubmit="return check()">
							<div id="owner-name" class="input-block">
								<label for="name" class="form-label">Name:</label>
								<input type="text" class="form-control" id="name" placeholder="Enter name"
									name="name">
							</div>
							<div id="tenant-name" class="input-block" style="display: none;">
								<div class="row">
									<div class="col">
										<label for="fname" class="form-label">First Name:</label>
										<input type="text" class="form-control" id="fname" placeholder="First Name" name="fname">
									</div>
									<div class="col">
										<label for="lname" class="form-label">Last Name:</label>
										<input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname">
									</div>
								</div>
							</div>
							<div class="radio-block">
								My identity is
								<input type="radio" id="owner" name="identity" value="Owner" checked="checked" onclick="hide(this)">
								<label for="html">Owner</label>
								<input type="radio" id="tenant" name="identity" value="Tenant" onclick="hide(this)">
								<label for="css">Tenant</label>
							</div>
							<div class="input-block">
								<label for="email" class="form-label">Email:</label>
								<input type="email" class="form-control" id="email" placeholder="Enter email"
									name="email">
							</div>
							<div class="input-block">
								<label for="mobile_no" class="form-label">Mobile:</label>
								<input type="number" class="form-control" id="mobile_no" placeholder="Enter Mobile" name="mobile_no">
							</div>
							<div class="input-block">
								<label for="occupation" class="form-label">Occupation:</label>
								<input type="text" class="form-control" id="occupation" placeholder="Enter Occupation" name="occupation">
							</div>
							<div id="location">
								<div class="row">
									<div class="col">
										<div class="input-block">
											<label for="country" class="form-label">Country:</label>
											<input type="text" class="form-control" id="country" placeholder="Country" name="country">
										</div>
									</div>
									<div class="col">
										<div class="input-block">
											<label for="state" class="form-label">State:</label>
											<input type="text" class="form-control" id="state" placeholder="State" name="state">
										</div>
									</div>
									<div class="col">
										<div class="input-block">
											<label for="city" class="form-label">City:</label>
											<input type="text" class="form-control" id="city" placeholder="City" name="city">
										</div>
									</div>
									<div class="col">
										<div class="input-block">
											<label for="no_of_houses" class="form-label">No. of Houses:</label>
											<input type="number" class="form-control" id="no_of_houses" placeholder="Number" name="no_of_houses">
										</div>
									</div>
								</div>
								<div class="input-block">
									<label for="address" class="form-label">Address:</label>
									<input type="text" class="form-control" id="address" placeholder="Address" name="address">
								</div>
							</div>
							
							<div class="input-block">
								<label for="pwd" class="form-label">Password:</label>
								<input type="password" class="form-control" id="pwd" placeholder="Enter password"
									name="pwd">
							</div>
							<div class="form-check">
								<a href="login-view.php">I already had an account in Conch?</a>
							</div>
							<div class="button-block d-grid">
								<button type="submit" class="btn btn-dark btn-block">Register</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</main>

		<script>
			function check(){
				var identity = document.forms["logon"]["identity"].value;
				var form = document.forms["logon"];
				form.method = "POST";
				if (identity=="Owner") {
					form.action = "../controller/user-controller.php?identity=owner&action=register";
				} else {
					form.action = "../controller/user-controller.php?identity=tenant&action=register";
				}
				form.submit();
				return false;
			}

			// different types of user need to input different kinds of information
			function hide(checkedRadio){
				checkedRadio.checked=true;
				if (checkedRadio.value == 'Tenant') {
					document.getElementById("owner-name").style.display = 'none';
					document.getElementById("tenant-name").style.display = '';
					document.getElementById("no_of_houses").style.display = 'none';
					document.getElementById("location").style.display = 'none';
				} else {
					document.getElementById("owner-name").style.display = '';
					document.getElementById("tenant-name").style.display = 'none';
					document.getElementById("no_of_houses").style.display = '';
					document.getElementById("location").style.display = '';
				}
			}
		</script>

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
