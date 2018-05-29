<html>
<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project- admin_login_failed.php

This is the page admins are directed to if their logins fail.
They are notified and able to try again.

 -->
<?php include_once 'includes\functionsIncluded.php';?>

<?php
		//check to see if the user is already logged in.
	if (isset($_POST['username'])&&isset($_POST['password'])):
		$username=mysql_real_escape_string($_POST['username']);
        $password=mysql_real_escape_string($_POST['password']);
		if (validate_user($username, $password)) { //successful login
			//set session data
			session_start();
			$_SESSION['user_id'] = $username;
			$_SESSION['logged_in'] = true;

			// Redirect:
			$url = absolute_url ('admin_portal.php');
			header("Location: $url");
			exit();
		} else { // Unsuccessful!

			session_start();
			$_SESSION['logged_in'] = false;
			$url = absolute_url ('admin_login_failed.php');
			header("Location: $url");
			exit();
		}
	else:
	//display form for users to log in		
	include_once 'admin_navigation.php';?>
	<div id="formStyle">
	<h2>Username or password incorrect, or the account is disabled. Please try again:</h2>
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
	            <td><input type='submit' value='login' /></td>
	        </tr>     
	    </table>
	</form>
<?php endif; ?>
</html>