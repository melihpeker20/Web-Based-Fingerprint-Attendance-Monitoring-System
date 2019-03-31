<?php 
include "functions.php"
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="css/favicon.ico" type="image/x-icon"> 
    <title>CLSU BIOMET-Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="css/login.css">
	<link rel="stylesheet" type="text/css" media="screen" href="css/modal.css">
</head>
<body class="text-center">
	<div class="header">
		<img class="mb-4" src="css/CLSU.png" alt="CLSU Logo" width="152" height="152">
		<h1 class="h3 mb-3 font-weight-normal">CLSU Campus Wide Biometrics</h1>
	</div>
	<form class="form-signin" method="post" action="login.php" >
    <?php echo display_error(); ?>
		<div class="input-group">
			<label class="sr-only" for="username">Username</label>
			<input class="form-control" type="text" name="username" placeholder="Username">
		</div>
		<div class="input-group">
			<label class="sr-only" for="password">Password</label>
			<input class="form-control" type="password" name="password" placeholder="Password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn btn-sm btn-success btn-block" name="login_btn">Login</button>
		</div>
	</form>
	<div class="row">
		<div class="col">
			<button class="btn btn-sm btn-warning" id="forgot_btn">Forgot Password?</button>
			<div id="forgotModal" class="modal">
				<!-- Modal content -->
				<div class="modal-content">
					<span class="close">&times;</span>
					<p>Kindly call Information Systems Institute for assistance.</p><br>
					<p>456-5267</p>
				</div>
			</div>
		</div>
	</div>

	<script>
	// Get the modal
	var modal = document.getElementById('forgotModal');

	// Get the button that opens the modal
	var btn = document.getElementById("forgot_btn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal 
	btn.onclick = function() {
	modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
	}
	</script>
</body>
</html>