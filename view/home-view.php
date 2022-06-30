<?php
// session_start();
include("../configs/session.php");
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.php');
}else {
    if ($_SESSION['loggedin']==false) {
        header('Location: ../index.php');
    }
}
include("../controller/connection.php");
$query="select * from logs WHERE tar_id=".$_SESSION['id']." AND tar_ide='".$_SESSION['identity']."' AND viewed=0";
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
		<link rel="stylesheet" href="../scss/index.css">
	</head>

	<body>

		<!-- broad section -->
		<div class="top-board jumbotron text-center">
			<div class="container">
				<h1>Conch</h1>
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
                <div class="container mb-5">
                    <div class="row align-items-md-stretch">
                        <!-- <div class="row"> -->
                            <div class="col-md-5">
                                <div class="p-4 mb-4 bg-light border rounded-3">
                                    <div class="py-2" id="disable-form">
                                        <h1 class="display-5 fw-bold">Welcome! <br><?php echo $_SESSION['name'] ?></h1>
                                        <div>
                                            <?php 
                                            if ($_SESSION['loggedin']) {
                                                if ($_SESSION['identity'] == 'owner') {
                                                    echo '<label for="exampleFormControlInput1">My Conch ID:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['o_id'].'" readonly>';

                                                    echo '<label for="exampleFormControlInput1">My Name:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['name'].'" readonly>';

                                                    echo '<label for="exampleFormControlInput1">My Email:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['email'].'" readonly>';

                                                    echo '<label for="exampleFormControlInput1">My Mobile:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['mobile_no'].'" readonly>';

                                                    echo '<label for="exampleFormControlInput1">My Occupation:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['occupation'].'" readonly>';

                                                    echo '<label for="exampleFormControlInput1">Number of Houses:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['no_of_houses'].'" readonly>';

                                                    echo '<label for="exampleFormControlInput1">My Country:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['country'].'" readonly>';

                                                    echo '<label for="exampleFormControlInput1">My State:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['state'].'" readonly>';

                                                    echo '<label for="exampleFormControlInput1">My City:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['city'].'" readonly>';

                                                    echo '<label for="exampleFormControlInput1">My Address:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['address'].'" readonly>';
                                                } else {
                                                    echo '<label for="exampleFormControlInput1">My Conch ID:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['t_id'].'" readonly>';

                                                    echo '<label for="exampleFormControlInput1">My Name:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['fname'].'" readonly>';

                                                    echo '<label for="exampleFormControlInput1">My Name:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['lname'].'" readonly>';

                                                    echo '<label for="exampleFormControlInput1">My Email:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['email'].'" readonly>';

                                                    echo '<label for="exampleFormControlInput1">My Mobile:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['mobile_no'].'" readonly>';

                                                    echo '<label for="exampleFormControlInput1">My Occupation:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['occupation'].'" readonly>';
                                                }
                                            } 
                                            ?>
                                        </div>
                                        <div class="col d-grid">
                                            <button class="btn btn-dark btn-lg mt-4" type="button" onclick="showEdit()" >Edit your personal information</button>
                                        </div>
                                        
                                    </div>

                                    <div class="py-2" id="hidden-form" style="display: none;">
                                        <form name="edit" id="edit" method="post" onsubmit="return check()">
                                            <input class="form-control" type="hidden" name="id" value="<?php echo $_SESSION["id"] ?>"/>
                                            <?php 
                                            if ($_SESSION['identity'] == 'owner') {

                                                    echo '<label for="exampleFormControlInput1">My Name:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['name'].'" id="name" name="name" >';

                                                    echo '<label for="exampleFormControlInput1">My Email:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['email'].'" id="email" name="email" >';

                                                    echo '<label for="exampleFormControlInput1">My Mobile:</label>';
                                                    echo '<input class="form-control" type="number" value="'.$_SESSION['userdata']['mobile_no'].'" id="mobile_no" name="mobile_no" >';

                                                    echo '<label for="exampleFormControlInput1">My Occupation:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['occupation'].'" id="occupation" name="occupation" >';

                                                    echo '<label for="exampleFormControlInput1">Number of Houses:</label>';
                                                    echo '<input class="form-control" type="number" value="'.$_SESSION['userdata']['no_of_houses'].'" id="no_of_houses" name="no_of_houses" >';

                                                    echo '<label for="exampleFormControlInput1">My Country:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['country'].'" id="country" name="country" >';

                                                    echo '<label for="exampleFormControlInput1">My State:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['state'].'" id="state" name="state" >';

                                                    echo '<label for="exampleFormControlInput1">My City:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['city'].'" id="city" name="city" >';

                                                    echo '<label for="exampleFormControlInput1">My Address:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['address'].'" id="address" name="address" >';
                                                } else {

                                                    echo '<label for="exampleFormControlInput1">My Name:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['fname'].'" id="fname" name="fname" >';

                                                    echo '<label for="exampleFormControlInput1">My Name:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['lname'].'" id="lname" name="lname" >';

                                                    echo '<label for="exampleFormControlInput1">My Email:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['email'].'" id="email" name="email" >';

                                                    echo '<label for="exampleFormControlInput1">My Mobile:</label>';
                                                    echo '<input class="form-control" type="number" value="'.$_SESSION['userdata']['mobile_no'].'" id="mobile_no" name="mobile_no" >';

                                                    echo '<label for="exampleFormControlInput1">My Occupation:</label>';
                                                    echo '<input class="form-control" type="text" value="'.$_SESSION['userdata']['occupation'].'" id="occupation" name="occupation" >';
                                                }
                                            ?>
                                            <div class="row">
                                                <div class="col d-grid">
                                                    <button class="btn btn-dark btn-lg mt-4" type="submit">Finish</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-dark btn-lg mt-4" type="button" onclick="hideEdit()" >Cancel</button>
                                                </div>
                                            </div>
                                        </form>

                                        <script>

                                        function showEdit(){
                                            document.getElementById("disable-form").style.display = 'none';
                                            document.getElementById("hidden-form").style.display = '';
                                        }

                                        function hideEdit(){
                                            document.getElementById("disable-form").style.display = '';
                                            document.getElementById("hidden-form").style.display = 'none';
                                        }

                                        function check(){
                                            var form = document.forms["edit"];
                                            var identity='<?php echo $_SESSION['identity'];?>';
                                            form.method = "POST";
                                            if (identity=="owner") {
                                                form.action = "../controller/user-controller.php?identity=owner&action=modify";
                                            } else {
                                                form.action = "../controller/user-controller.php?identity=tenant&action=modify";
                                            }
                                            form.submit();
                                            return false;
                                        }

                                    </script>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="p-5 text-white bg-dark rounded-3 d-grid">
                                    <h2>News</h2>
                                    <p>There are notifications from this website</p>
                                    <?php 
                                    if ($data) {
                                        # code...
                                        while($result=mysqli_fetch_assoc($data)){
                                            echo '<div class="notification-bar container mb-3">';
                                                echo '<div class="row">';
                                                    echo '<div class="col-sm-5">';
                                                        echo '<a href="#" style="text-decoration: none; color: white;">'.$result['action'].'</a>';
                                                    echo '</div>';
                                                    echo '<div class="col-sm-6">';
                                                        echo '<a href="#" style="text-decoration: none; color: white;">'.$result['date'].'</a>';
                                                    echo "</div>";
                                                    echo '<div class="col-sm-1">';
                                                    echo '<form action="../controller/log.php?method=modify" type="hidden" method="post">';
                                                        echo '<input type="hidden" name="id" value="'.$result['id'].'">';
                                                        echo '<button class="btn btn-danger" type="submit" style="padding: 5% 25%;">';
//                                                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">';
//                                                            echo '<path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>';
//                                                        echo '</svg>';
                                                        echo '</button>';
                                                    echo '</form>';
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        }
                                    }else {
                                       echo '<p>No notification in your news</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="h-100 p-5 text-white bg-dark rounded-3">
                                    <h2>Change the background</h2>
                                    <p>Swap the background-color utility and add a `.text-*` color utility to mix up the jumbotron look. Then, mix and match with additional component themes and more.</p>
                                    <a class="btn btn-outline-light" type="button">Example button</a>
                                </div>
                            </div> -->
                        <!-- </div> -->
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
						if (isset($_SESSION['loggedin'])) {
							if ($_SESSION['loggedin']==true) {
								if ($_SESSION['identity'] == 'owner') {
									echo '<li class="nav-item"><a href="../view/my-house-view.php" class="nav-link px-2 text-muted">My House</a></li>';
									echo '<li class="nav-item"><a href="../view/my-booking-view.php" class="nav-link px-2 text-muted">My Booking</a></li>';
								} else {
									echo '<li class="nav-item"><a href="../view/my-booking-view.php" class="nav-link px-2 text-muted">My Booking</a></li>';
								}
							}
						} 
						?>
					</ul>
				</footer>
			</div>
		</div>

	</body>

</html>
