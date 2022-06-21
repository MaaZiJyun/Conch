<?php
session_start();
$o_id=$_GET['o_id'];
$h_id=$_GET['h_id'];
$rate=$_GET['rate'];
$t_id=$_SESSION['id'];
// echo '<script> alert("'.$_GET['rate'].'");</script>';
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
			<h1>Booking</h1>
			<p>Please check carefully your information before booking</p>
		</div>
	</div>
	
	<!-- content -->
	<main>
		<div class="content">
			<div class="container">
			    <div class="center login-card">
					<form name="booking" id="booking" method="post" onsubmit="return upload()">
                        <input class="form-control" type="hidden" name="action" value="booking"/>
                        <div class="row">
                            <div class="col">
                                <div class="input-block">
                                    <label for="email" class="form-label">Owner ID:</label>
                                    <input type="number" class="form-control" id="o_id" value="<?php echo $o_id; ?>" name="o_id" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-block">
                                    <label for="email" class="form-label">House ID:</label>
                                    <input type="number" class="form-control" id="h_id" value="<?php echo $h_id; ?>" name="h_id" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-block">
                                    <label for="email" class="form-label">Tenant ID(You):</label>
                                    <input type="number" class="form-control" id="t_id" value="<?php echo $t_id; ?>" name="t_id" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="input-block">
                                    <label for="email" class="form-label">Duration(M):</label>
                                    <input type="number" class="form-control" id="duration" name="duration" onchange="change()">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-block">
                                    <label for="pwd" class="form-label">Rate(CNY/M):</label>
                                    <input type="number" class="form-control" id="rate" value="<?php echo $rate; ?>" name="rate" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-block">
                                    <label for="pwd" class="form-label">Price(CNY):</label>
                                    <input type="number" class="form-control" id="price" name="price" readonly>
                                </div>
                            </div>
                        </div>
						<div class="button-block d-grid">
							<button type="submit" class="btn btn-dark btn-block">Submit</button>
						</div>
					</form>
                    <script>
                        function change(){
                            var duration = document.getElementById('duration').value;
                            var rate='<?php echo $rate;?>';
                            var price = document.getElementById('price');
                            price.value = rate*duration;
                        }

                        function log(){
                            var logform = document.createElement("form");
                            var ori_ide = document.createElement("input");
                            ori_ide.value = "tenant";
                            logform.appendChild(ori_ide);
                            var tar_ide = document.createElement("input");
                            tar_ide.value = "owner";
                            logform.appendChild(tar_ide);
                            var ori_id = document.createElement("input");
                            ori_id.value = "<?php echo $_SESSION['id'] ?>";
                            logform.appendChild(ori_id);
                            var tar_id = document.createElement("input");
                            tar_id.value = "<?php echo $o_id ?>";
                            logform.appendChild(tar_id);
                            var action = document.createElement("input");
                            action.value = "Booking";
                            logform.appendChild(action);
                            var date = document.createElement("input");
                            date.value = date("Y-m-d");
                            logform.appendChild(date);
                            var viewed = document.createElement("input"); 
                            viewed.value = 0;
                            logform.appendChild(viewed);
                            logform.method="POST";
                            form.action = "../controller/log.php?action=register";
                            form.submit();
                            
                        }

                        function upload(){
                            var duration = document.getElementById('duration').value;
                            if (duration) {
                                // var form = document.forms["booking"];
                                // form.method = "POST";
                                // form.action = "../controller/log.php?action=register";
                                // form.submit();
                                return false;
                            } else {
                                alert('Please input the duration before submit');
                            }
                        }
                    </script>
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