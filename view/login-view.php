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
			<h1>Login</h1>
			<p>Resize this responsive page to see the effect!</p>
		</div>
	</div>
	
	<!-- content -->
	<main>
		<div class="content">
			<div class="container">
			    <div class="center login-card">
					<form name="login" id="login" action="../view/login-view.html" method="post" onsubmit="return check()">
						<div class="radio-block">
							My identity is
							<input type="radio" id="owner" name="identity" value="Owner" checked="checked">
							<label for="html">Owner</label>
							<input type="radio" id="tenant" name="identity" value="Tenant">
							<label for="css">Tenant</label>
						</div>
						<div class="input-block">
							<label for="email" class="form-label">Email:</label>
							<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
						</div>
						<div class="input-block">
							<label for="pwd" class="form-label">Password:</label>
							<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
						</div>
						<div class="form-check">
							<a href="logon-view.php">Don't have an account in Conch?</a>
						</div>
						<div class="button-block d-grid">
							<button type="submit" class="btn btn-dark btn-block">Log in</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</main>

	<script>
		function check() {
			var email = document.forms["login"]["email"].value;
			var pwd = document.forms["login"]["pwd"].value;
			if (email != '' && pwd !='') {
				var identity = document.forms["login"]["identity"].value;
				var form = document.forms["login"];
				form.method = "POST";
				if (identity == "Owner") {
					form.action = "../controller/user-controller.php?identity=owner&action=login";
				} else {
					form.action = "../controller/user-controller.php?identity=tenant&action=login";
				}
				form.submit();
				return false;
			} else {
				alert('Please fill in both email and password');
			}
		}
	</script>
	
	<!-- footer -->
	<div class="footer container-fluid">
		<div class="container">
			<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
			  <p class="col-md-4 mb-0 text-muted">&copy; 2022 Company, Inc</p>
				
			  <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
			    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
			  </a>
				
			  <ul class="nav col-md-4 justify-content-end">
			    <li class="nav-item"><a href="../index.html" class="nav-link px-2 text-muted">Home</a></li>
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