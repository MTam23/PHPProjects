<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - checkout.php

This page displays the customer's current cart and takes 
credit card information
-->


<?php 
	session_start();
    include_once 'includes\functionsIncluded.php';
	include_once 'customer_navigation.php'; 
	if(!isset($_SESSION['my_Cart'])) {
		$_SESSION['my_Cart']=array();	
	} 	
 ?>

<html>
<head>
    <title>Cart</title>
</head>
	<div id="formLeft">
	<h2>Your Cart:</h2>

	<?php	
        //display the cart or let the customer know the cart is empty
		$total=show_cart(FALSE);
		if($total==FALSE) {
			echo "<h2>Your Cart is Empty</h2>";
			echo "<p><a href=catalog.php>Browse for items</a></p>";
		} else { ?>	
				<h3>Your total is: $<?php echo number_format($total, 2)?></h3>
			</div>		
			<?php
		} ?>

    <div id="right_side">
    	<h3>Enter Payment Information:</h3>
    	<form action='payment_confirm.php' method='post'>
        <table align="center" style="margin: 0px auto;" cellpadding=10>
            <tr align="left">
                <td colspan=2 >
                <p>Please do not enter actual information</p>
                <p>The card number 5454545454545454 will be accepted</p>
                <p>All others will be rejected. </p>
                </td>
            </tr>
            <tr>
                <td>Name on Card:</td>
                <td><input type='text' name='full_name' required/></td>
            </tr>
            <tr>
                <td>Card Number:</td>
                <td><input type='number' name='card_no' required/></td>
            </tr>
            <tr>
                <td>Expiration Date:</td>
                <td><input type='month' name='exp_date' required /></td>
            </tr>
            <tr>
                <td>CID:</td>
                <td><input type='number' name='cid' min="0" required /></td>
            </tr>
            <tr>
                <td><input type='hidden' name='total' value= <?php echo $total ?> /></td>
                <td><input type='submit' value="Checkout" /></td>
            </tr>
            
        </table>
    	</form>
    </div>
</html>

