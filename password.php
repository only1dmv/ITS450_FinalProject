<!DOCTYPE html>
<html>
<head>
<title>Change Password</title>
<style type="text/css">
fieldset {
	width:500px;
	border:5px dashed #CCCCCC;
	margin:0 auto;
	border-radius:5px;
}
 
legend {
	color: blue;
	font-size: 25px;
}
 
dl {
	float: right;
	width: 390px;
}
 
dt {
	width: 180px;
	color: brown;
	font-size: 19px;
}
 
dd {
	width:200px;
	float:left;
}
 
dd input {
	width: 200px;
	border: 2px dashed #DDD;
	font-size: 15px;
	text-indent: 5px;
	height: 28px;
}
 
.btn {
	color: #fff;
	background-color: dimgrey;
	height: 38px;
	border: 2px solid #CCC;
	border-radius: 10px;
	float: right;
}
 
</style>
</head>
 
<body>
	<fieldset>
		<legend>Change Password</legend>
	<?php 
		require('./includes/config.inc.php');
		require(MYSQL);
		$conn_db = mysqli_connect("localhost","root","toor");
		$sel_db = mysqli_select_db($conn_db, "ecommerce2");
		if(isset($_POST['re_password']))
		{
		$old_pass=$_POST['old_pass'];
		$new_pass=$_POST['new_pass'];
		$re_pass=$_POST['re_pass'];
		$old_pass=stripslashes($old_pass);
		$new_pass=stripslashes($new_pass);
		$re_pass=stripslashes($re_pass);
		$old_pass=mysqli_real_escape_string($conn_db, $old_pass);
		$new_pass=mysqli_real_escape_string($conn_db, $new_pass);
		$re_pass=mysqli_real_escape_string($conn_db, $re_pass);
		$chg_pwd=mysqli_query($conn_db, "SELECT * FROM login WHERE id='1'");
		$chg_pwd1=mysqli_fetch_array($chg_pwd);
		$data_pwd=$chg_pwd1['pass'];
		//echo '<script type="text/javascript">alert("'.$data_pwd.'");</script>';
		if($data_pwd==$old_pass){
		if($new_pass==$re_pass){
			$update_pwd=mysqli_query($conn_db, "UPDATE login SET pass='$new_pass' WHERE id='1'");
			echo "<script>alert('Update Sucessfully'); window.location='https://localhost/login.php'</script>";
		}
		else{
			echo "<script>alert('Your new and Retype Password is not match'); window.location='index.php'</script>";
		}
		}
		else
		{
		echo "<script>alert('Your old password is wrong'); window.location='https://localhost/password.php'</script>";
		}}
	?>
 
	<form method="post">
		<dl>
			<dt>
				Old Password
			</dt>
				<dd>
					<input type="password" name="old_pass" placeholder="Old Password..." value="" required />
				</dd>
		</dl>
		<dl>
			<dt>
				New Password
			</dt>
				<dd>
					<input type="password" name="new_pass" placeholder="New Password..." value=""  required />
				</dd>
		</dl>
		<dl>
			<dt>
				Retype New Password
			</dt>
				<dd>
					<input type="password" name="re_pass" placeholder="Retype New Password..." value="" required />
				</dd>
		</dl>
 
		<p align="center">
			<input type="submit" class="btn" value="Reset Password" name="re_password" />
		</p>
	</form>
	</fieldset>
</body>
</html>
