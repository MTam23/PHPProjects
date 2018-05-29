<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - add_one.php

When customers add an item, they are redirected to this page.
An item is then added to their cart ($_SESSION['my_Cart']) and
they are redirected to cart.php
-->

<?php
	session_start();
	$item=$_GET['item'];
	//add the item $item to the cart ($_SESSION['my_Cart'])
	//create the new key value pair or add an additional item
	//to an existing entry.
	if(!isset($_SESSION['my_Cart'][$item])) {
		$_SESSION['my_Cart'][$item]=1;
	} else {
		$_SESSION['my_Cart'][$item]+=1;
	}
	//redirect user to cart
	header('location:cart.php');
?>