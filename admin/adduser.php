<?php 
include "../functions.php";
include "header.php";
include "footer.php";

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Record</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<style>
        .active, #userlink{
        background-color: #ffffff;
        color: #000000;
        }
    </style>
</head>
<body>
	<div class="container">
		<div class="row">
				<div class="col-md-12 text-center mt-3">
					<img class="mb-4" src="../css/CLSU.png" alt="CLSU Logo" width="100" height="100">
					<h2>User Record</h2>
					<p>Please fill this form and submit to add user record.</p>
				</div>
				<div class="col-md-12">
					<form method="post" action="adduser.php">
						<?php echo display_error(); ?>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Username</label>
									<input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
								</div>
							</div>
							<div class="col-sm-6">	
								<div class="form-group">
									<label>User type</label>
									<select class="form-control" name="usertype" id="usertype" >
										<option>Choose</option>
										<option value="Admin">Admin</option>
										<option value="Record-in-Charge">Record-in-Charge</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Password</label>
									<input class="form-control" type="password" name="password_1">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Confirm password</label>
									<input class="form-control" type="password" name="password_2">
								</div>
							</div>
						</div>
						<hr class="mb-4">
							<input type="submit" class="btn btn-warning" name="register_btn" value="Submit">
							<a href="users_view.php" class="btn btn-danger">Cancel</a>
					</form>
				</div>
		</div>
	</div>
</body>
</html>