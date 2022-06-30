<?php
session_start();
if (isset($_SESSION['loggedin'])) {
	if ($_SESSION['loggedin']) {
		header('Location: ../view/index.php');
	}
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

		<style>
			#message {
				background: #f1f1f1;
				color: #000;
				position: relative;
				padding: 20px;
				margin-top: 10px;
			}

			#message p {
				padding: 10px 35px;
				font-size: 18px;
			}

			/* Add a green text color and a checkmark when the requirements are right */
			.valid {
			color: green;
			}

			/* Add a red text color and an "x" when the requirements are wrong */
			.invalid {
			color: red;
			}
		</style>

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
						<form name="logon" id="logon" action="../view/logon-view.php" method="post" onsubmit="return check()">
							<div id="owner-name" class="input-block">
								<label for="name" class="form-label">Name:</label>
								<input type="text" class="form-control" id="name" placeholder="Enter name"
									name="name" required>
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
									name="email" required>
							</div>
							<div class="input-block">
								<label for="mobile_no" class="form-label">Mobile:</label>
								<input type="number" class="form-control" id="mobile_no" placeholder="Enter Mobile" name="mobile_no" required>
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


							<!-- This is where the solusion -->
							<div class="input-block">
								<label for="pwd" class="form-label">Password:</label>
								<input 
									type="password" 
									class="form-control" 
									id="pwd" 
									placeholder="Enter password"
									name="pwd" 
									pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
									title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or 20 characters"
								required>
							</div>
							<div id="message-box" style="display: none;">
								<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
								<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
								<p id="number" class="invalid">A <b>number</b></p>
								<p id="length" class="invalid">Minimum <b>8 characters</b></p>
							</div>
							<!-- This is where the solusion -->

							<!-- This is where the solusion -->
							<div class="input-block">
								<label for="pwd2" class="form-label">Password Validate:</label>
								<input 
									type="password" 
									class="form-control" 
									id="pwd2" 
									placeholder="Enter password"
									name="pwd2" 
								required>
							</div>
							<div id="message-box2" style="display: none;">
								<p id="same-pwd" class="invalid">Your second input is different from the previous one</p>
							</div>
							<!-- This is where the solusion -->


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
			//This is where the solusion begin
			var myInput = document.getElementById("pwd");
			var myInput2 = document.getElementById("pwd2");
			var letter = document.getElementById("letter");
			var capital = document.getElementById("capital");
			var number = document.getElementById("number");
			var length = document.getElementById("length");
			var double = document.getElementById("same-pwd");
			//all boolean
			var hasLetter = false;
			var hasCapital = false;
			var hasNumber = false;
			var hasLength = false;
			var samePwd = false;
			// When the user clicks on the password field, show the message box
			myInput.onfocus = function() {
				document.getElementById("message-box").style.display = "block";
			}
			myInput2.onfocus = function() {
				document.getElementById("message-box2").style.display = "block";
			}
			// When the user clicks outside of the password field, hide the message box
			myInput.onblur = function() {
				document.getElementById("message-box").style.display = "none";
			}
			myInput2.onblur = function() {
				document.getElementById("message-box2").style.display = "none";
			}
			// When the user starts to type something inside the password field
			myInput.onkeyup = function() {
				// Validate lowercase letters
				var lowerCaseLetters = /[a-z]/g;
				if(myInput.value.match(lowerCaseLetters)) {  
					letter.classList.remove("invalid");
					letter.classList.add("valid");
					hasLetter = true;
				} else {
					letter.classList.remove("valid");
					letter.classList.add("invalid");
					hasLetter = false;
				}
				
				// Validate capital letters
				var upperCaseLetters = /[A-Z]/g;
				if(myInput.value.match(upperCaseLetters)) {  
					capital.classList.remove("invalid");
					capital.classList.add("valid");
					hasCapital = true;
				} else {
					capital.classList.remove("valid");
					capital.classList.add("invalid");
					hasCapital = false;
				}
				// Validate numbers
				var numbers = /[0-9]/g;
				if(myInput.value.match(numbers)) {  
					number.classList.remove("invalid");
					number.classList.add("valid");
					hasNumber = true;
				} else {
					number.classList.remove("valid");
					number.classList.add("invalid");
					hasNumber = false;
				}
				
				// Validate length
				if(myInput.value.length >= 8) {
					length.classList.remove("invalid");
					length.classList.add("valid");
					hasLength = true;
				} else {
					length.classList.remove("valid");
					length.classList.add("invalid");
					hasLength = false;
				}
			}
			myInput2.onkeyup = function(){
				if(myInput2.value === myInput.value) {
					double.classList.remove("invalid");
					double.classList.add("valid");
					samePwd = true;
				} else {
					double.classList.remove("valid");
					double.classList.add("invalid");
					samePwd = false;
				}
			}
			function check(){
				if (samePwd) {
					if (hasLetter && hasCapital && hasNumber && hasLength) {
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
					} else {
						alert("Your password is invalid");
						return false;
					}
				} else {
					alert("Your Password Validate is different with Password");
					return false;
				}
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
						?>
					</ul>
				</footer>
			</div>
		</div>

	</body>

</html>
