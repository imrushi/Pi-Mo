<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<!-- <link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" type="image/png" href="/Logo.png"> -->

	<link rel="stylesheet" type="text/css" href="logassets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="logassets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="logassets/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="logassets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="logassets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="logassets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="logassets/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="logassets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="logassets/css/util.css">
	<link rel="stylesheet" type="text/css" href="logassets/css/main.css">
</head>
<body>
	<!-- <div class="header">
		<h2>Register</h2>
	</div> -->
	<div class="container-login100">
		<div class="wrap-login100 p-l-50 p-r-50 p-t-30 p-b-10">
			
	<form  class="login100-form validate-form" method="post" action="register.php">
	<span class="login100-form-title p-b-37">
				Register
				</span>
	

		<?php include('errors.php'); ?>

		<div class="wrap-input100 validate-input m-b-20" data-validate="Enter username">
			<!-- <label>Username</label> -->
			<input class="input100" type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
			<span class="focus-input100"></span>
		</div>
		<div class="wrap-input100 validate-input m-b-25" data-validate = "Enter Email">
			<!-- <label>Email</label> -->
			<input class="input100" type="email" name="email" value="<?php echo $email; ?>" placeholder="Email">
			<span class="focus-input100"></span>
		</div>
		<div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">
			<!-- <label>Password</label> -->
			<input class="input100" type="password" name="password_1" placeholder="Password">
			<span class="focus-input100"></span>
		</div>
		<div class="wrap-input100 validate-input m-b-25" data-validate = "Confirm password">
			<!-- <label>Confirm password</label> -->
			<input class="input100" type="password" name="password_2" placeholder="Confirm Password">
			<span class="focus-input100"></span>
		</div>
		<div class="wrap-input100 validate-input m-b-20" data-validate="Enter Vehicle Name">
			<!-- <label>Username</label> -->
			<input class="input100" type="text" name="VehName" value="<?php echo $VehName; ?>" placeholder="Vehicle Name">
			<span class="focus-input100"></span>
		</div>
		<div class="container-login100-form-btn">
			<button type="submit" class="login100-form-btn" name="reg_user">Register</button>
		</div>
		<p><br>
		<div class="text-center"> Already a member? <a href="login.php" class="txt2 hov1">Sign in</a></div>
		</p>
	</form>

	

			
</div>
</div>
</body>

<script src="logassets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="logassets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="logassets/vendor/bootstrap/js/popper.js"></script>
	<script src="logassets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="logassets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="logassets/vendor/daterangepicker/moment.min.js"></script>
	<script src="logassets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="logassets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="logassets/js/main.js"></script>
</html>