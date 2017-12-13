<!-- jQuery library (served from Google) -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js">
$(document).ready(function(){
  $('.bxslider').bxSlider();
});
</script>
<!-- bxSlider Javascript file -->
<script src="/js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="/lib/jquery.bxslider.css" rel="stylesheet" />


<?php

session_start();
if(isset($_SESSION['login_user']))
{
	header("location: admin/index.php"); // Redirecting To Other Page
}

require('./includes/product_functions.inc.php');
// Require the configuration before any PHP code:
require ('./includes/config.inc.php');


// Create a page title:
$page_title = "Login";

// Include the header file:
include ('./includes/header.html');

// Require the database connection:
require (MYSQL);

?>

<div style="background-color:rgba(255, 255, 255, 0.8); border-style: solid;">
<h3>Login</h3>
<p name="loginMessage">Try Logging In </p>
<form action="login.php" method="post" accept-charset="utf-8">
<p>Username:</p>
<input type="text" name="user" /><br />
<p>Password:</p>
<input type="password" name="password" />
<br />
<input type="Submit" value="Login" name='submit' class="button" />
<p name="changepassword"><a href="/password.php">Change Password </a></p>
</form>
<?php
	//session_start(); // Starting Session
	$error=''; // Variable To Store Error Message
	if (isset($_POST['submit'])) 
	{
		if (empty($_POST['user']) || empty($_POST['password'])) 
		{
			$error = "Username or Password is invalid";
		}
		else
		{
			// Define $username and $password
			$username=$_POST['user'];
			$password=$_POST['password'];
			// Establishing Connection with Server by passing server_name, user_id and password as a parameter
			$connection = mysqli_connect("localhost", "root", "toor");
			// To protect MySQL injection for Security purpose
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = mysqli_real_escape_string($connection, $username);
			$password = mysqli_real_escape_string($connection, $password);
			// Selecting Database
			$db = mysqli_select_db($connection, "ecommerce2");
			// SQL query to fetch information of registerd users and finds user match.
			$query = mysqli_query($connection, "SELECT * FROM login where userName = '$username' AND pass = '$password'");
			$rows = mysqli_num_rows($query);
			if ($rows == 1) 
			{
				//session_start();
				$_SESSION['login_user']=$username; // Initializing Session
				header("location: admin/index.php"); // Redirecting To Other Page
				
			} 
			else 
			{
				$error = "Username or Password is invalid";
				echo $error;
			}
			mysqli_close($connection); // Closing Connection
		}
	}

?>
</div>

<?php
// Include the footer file:
include ('./includes/footer.html');
?>
