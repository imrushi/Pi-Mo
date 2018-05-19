<?php 
	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$VehName  = "";
	$errors = array(); 
	$_SESSION['success'] = "";
	$user_id = "";
	
	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'registration');
	
	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		$VehName = mysqli_real_escape_string($db, $_POST['VehName']);
		$sql_u = "SELECT * FROM users WHERE username='$username'";
		$sql_e = "SELECT * FROM users WHERE email='$email'";
		$res_u = mysqli_query($db, $sql_u);
		$res_e = mysqli_query($db, $sql_e);
		$row = mysqli_fetch_array($sql_u);
		$user_id = $row['id'];

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }

  	if (mysqli_num_rows($res_u) > 0) {
  	  array_push($errors, "Sorry... username already taken"); 	
	  }
	  if(mysqli_num_rows($res_e) > 0){
  	  array_push($errors, "Sorry... email already taken"); 	
	  }
	  
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, password, VehName) 
					  VALUES('$username', '$email', '$password', '$VehName')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['id'] = $user_id;
			$_SESSION['VehName'] = $VehName;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.html');
			$file = fopen("id.txt","w+");
			$s = ($user_id);
			fputs($file,$s);
			fclose($file);
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);
			$row = mysqli_fetch_array($results);
			$user_id = $row['id'];
			$VehName = $row['VehName'];

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['id'] = $user_id;
				$_SESSION['VehName'] = $VehName;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.html');
				$file = fopen("id.txt","w+");
				$s = ($user_id);
				fputs($file,$s);
				fclose($file);
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

?>