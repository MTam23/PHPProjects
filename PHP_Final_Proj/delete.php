<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - delete.php

This page deletes an item from the cart and redirects the customer back to the cart.
-->
<?php
	session_start();
	$item=$_GET['id'];
	unset($_SESSION['my_Cart'][$item]);
	header('location:cart.php');
?>