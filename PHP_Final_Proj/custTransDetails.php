<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - custTransDetails.php

This page displays specific information of a customer's transaction
-->

<html>
<head>
<title>Transaction Details</title>
</head>

<?php 
	session_start();
    include_once 'includes\functionsIncluded.php';
	include_once 'customer_navigation.php'; 
	$rec_num=$_GET['rec'];
	get_rec($rec_num);
 ?>
</html>