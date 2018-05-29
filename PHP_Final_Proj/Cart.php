<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - Cart.php

This page displays the user's current cart and allows them to delete items.
-->

<html>
<head>
<title>Cart</title>
</head>

<?php include_once 'includes\functionsIncluded.php';?>

<?php
	session_start();
	include_once 'customer_navigation.php'; 
	//make sure the cart is set
	if(!isset($_SESSION['my_Cart'])) {
		$_SESSION['my_Cart']=array();	
	} 	
 ?>
	<div id="formStyle"> 
		<h2>Your Cart:</h2>
		<?php		
			//display the total and call show_cart() to display the cart
			$total=show_cart();
			if($total==FALSE) {
				echo "There is nothing in your cart.";
				echo "<p><a href=catalog.php>Browse for items</a></p>";
			} else {
				echo "<h3>Your total is: $" . number_format($total, 2);
				echo "<div style='float:right'><a href=checkout.php><input type='submit' value='Checkout'></a></div>";
			}
        ?>
</html>

