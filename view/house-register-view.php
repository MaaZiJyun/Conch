<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.php');
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
				<h1>House Register</h1>
				<p>Please fill up the information of your house</p>
			</div>
		</div>

		<!-- content -->
		<main>
			<div class="content">
				<div class="container">
					<div class="center login-card">
						<form method="POST" enctype="multipart/form-data" action="../controller/log.php?method=register&table=house&nolog=yes">
							<div class="input-block">
								<label for="ownername" class="form-label">Owner Name:</label>
								<input type="text" class="form-control" id="ownername" value="<?php echo $_SESSION['userdata']['name'];?> (Name of this account)"
									name="ownername" disabled>
								<input type="hidden" id="owner_id" name="owner_id" value="<?php echo $_SESSION['id'];?>">
							</div>
							<div class="row">
								<div class="col">
									<div class="input-block">
										<label for="noofrooms" class="form-label">No of Rooms:</label>
										<input type="number" class="form-control" id="no_of_rooms" placeholder="Enter No of Rooms"
											name="no_of_rooms">
									</div>
								</div>
								<div class="col">
									<div class="input-block">
										<label for="rate" class="form-label">Rate:</label>
										<input type="number" class="form-control" id="rate" placeholder="Enter Rate of month"
											name="rate">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="input-block">
										<label for="country" class="form-label">Country:</label>
										<input type="text" class="form-control" id="country" placeholder="Country"
											name="country">
									</div>
								</div>
								<div class="col">
									<div class="input-block">
										<label for="state" class="form-label">State:</label>
										<input type="text" class="form-control" id="state" placeholder="State"
											name="state">
									</div>
								</div>
								<div class="col">
									<div class="input-block">
										<label for="city" class="form-label">City:</label>
										<input type="text" class="form-control" id="city" placeholder="City"
											name="city">
									</div>
								</div>
							</div>
							<div class="input-block">
								<label for="address" class="form-label">Address:</label>
								<input type="text" class="form-control" id="address" placeholder="Street, Road, Community, etc."
									name="address">
							</div>
							<div class="input-block">
								<label for="pics" class="form-label">House Picture:</label>
								<input type="file" class="form-control" id="pics" placeholder="Upload Picture of House"
									name="pics">
							</div>
							<div class="input-block">
								<label for="desc" class="form-label">Description:</label>
								<textarea row="5" type="text" class="form-control" id="description" placeholder="Add more information of your house"
									name="description"></textarea>
							</div>
							<div class="button-block d-grid">
								<button type="submit" name="submit" class="btn btn-dark btn-block">Register Your House</button>
							</div>
						</form>
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
