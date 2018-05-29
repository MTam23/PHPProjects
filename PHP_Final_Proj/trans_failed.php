<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - trans_failed.php

This page appears if there was an issues with the payment information.
It includes a link for users to checkout again.
-->
<?php
	session_start();
	include_once 'customer_navigation.php'; 
	include_once 'includes\functionsIncluded.php';
?>

<html>
<head>
<title>Cart</title>
</head>
	<div id="formStyle"> 
		<h2>There was an error with your payment.</h2>
		<h2>Click <a href=checkout.php>HERE</a> to try again.</h2>
	</div>
</html>

