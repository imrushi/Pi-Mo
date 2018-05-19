<?php 
	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
        header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
<style>
div.container {
    width: 100%;
    border: 1px solid gray;
}

header, footer {
    padding: 1em;
    color: white;
    background-color: black;
    clear: left;
    text-align: center;
}

nav {
    float: left;
    max-width: 160px;
    margin: 0;
    padding: 1em;
}

nav ul {
    list-style-type: none;
    padding: 0;
}
   
nav ul a {
    text-decoration: none;
}

article {
    margin-left: 170px;
    border-left: 1px solid gray;
    padding: 1em;
    overflow: hidden;
}
</style>
</head>
<body>
<div class="header">
	</div>
	<div class="content">
	<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

<div class="container">

<header>
   <h1>Settings</h1>
</header>
  
<nav>
  <ul>
    <li><h1>Welcome user<h1></li>
  </ul>
</nav>

<article>
<?php  if (isset($_SESSION['username'])) : ?>
            <p>UserName: <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p>Distance Traveled:</p>
            <div class="input-group">
            <p><button type="About" class="btn" name="reg_Abt">About</button>
			<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
		<?php endif ?>
</article>

<footer>PIMO</footer>

</div>

</body>
</html>