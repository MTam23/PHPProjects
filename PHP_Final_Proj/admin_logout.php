<html>
<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project- admin_logout.php

This page displays when users log out. They are notified and given a link to log back in
 -->
<?php 
	session_start();
	include_once 'includes\functionsIncluded.php';
	$_SESSION['logged_in'] = false;
	include_once 'admin_navigation.php'; ?>

<div id="formStyle"> 

<?php
	if (isset($_SESSION['user_id'])): 
			session_destroy(); //destroy the current session ?>

			<h1>You have logged out<h1>
			<h3>Please <a href=admin_login.php><font color="blue">log in</font></a>.</h3>
	<?php else: ?>
			<h3>You are not logged in. Please <a href=admin_login.php><font color="blue">log in</font></a>.</h3>
	<?php endif ?>
</div>
</html>