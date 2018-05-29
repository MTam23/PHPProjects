<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - Admin_Login.php

This is the login page for administrators. After they log in, they can edit available items,
create new admins, and view transactions.

-->
<?php 
	session_start();
	include_once 'includes\functionsIncluded.php';
?>

<html>
<head>
<title>ADMIN LOGIN - PHP FINAL PROJECT</title>
</head>

<?php
	//check to see if the user is already logged in.
	if (isset($_SESSION['user_id']) && isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true):
		include_once 'admin_navigation.php';
		echo "<div id='formStyle'>";
		echo "<h2>You are already logged in.<h2>";
		echo "</div>";
	//otherwise, check to see if a username/password was entered, validate it, and redirect the user
	elseif (isset($_POST['username'])&&isset($_POST['password'])):
		$username=mysql_real_escape_string($_POST['username']);
        $password=mysql_real_escape_string($_POST['password']);

		if (validate_user($username, $password)) { //successful login
			//set session data
			$_SESSION['user_id'] = $username;
			$_SESSION['logged_in'] = true;
			$_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

			// Redirect:
			if (!headers_sent()) {
				$url = absolute_url ('admin_portal.php');
				header("Location: $url");
				exit();
			}
		} else { // Unsuccessful!

			$_SESSION['logged_in'] = false;
			if (!headers_sent()) {
				$url = absolute_url ('admin_login_failed.php');
				header("Location: $url");
				exit();
			}
		}
	else:
	//display form for users to log in
	include_once 'admin_navigation.php';?>
	<div id="formStyle">
	<h2>Administrators, please log in below:</h2>
	<form action='' method='post' style='text-align:center'>
	    <table align="center" style="margin: 0px auto;" cellpadding=10 width=550>
	        <tr>
	            <td>Username:</td>
	            <td><input type='text' name='username' value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" required /></td>
	        </tr>
	        <tr>
	            <td>Password:</td>
	            <td><input type='password' name='password' required/></td>
	        </tr>
	        <tr>
	            <td></td>
	            <td><input type='submit' value='LOGIN' /></td>
	        </tr>     
	    </table>
	</form>
<?php endif; ?>

</html>