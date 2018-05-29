<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - payment_confirm.php

This page asks customers to confirm their enterred payment information.
-->

<html>
<head>
<title>Confirm Transaction</title>
</head>

<?php 
	session_start();
    include_once 'includes\functionsIncluded.php';
	include_once 'customer_navigation.php'; 
	if(!isset($_SESSION['my_Cart'])) {
		$_SESSION['my_Cart']=array();	
	} 	
 ?>
 		<div id="formLeft">
		<h2>Please confirm items in your Cart:</h2>
	
		<?php
            //display the cart and the current total.
			$total=show_cart(FALSE);
			if($total==FALSE) {
				echo "<h2>Your Cart is Empty</h2>";
				echo "<p><a href=catalog.php>Browse for items</a></p>";
			} else {
				?>
					<h3>Your total is: $<?php echo number_format($total, 2)?></h3>
				</div>				
				<?php
			}
        ?>
        <!--Display the previously entered payment information and give users the choice to confirm
            or go back -->
        <div id="right_side">
        	<h3>Please Confirm Payment Information:</h3>
        	<form action='receipt.php' method='post'>
            <table align="center" style="margin: 0px auto;" cellpadding=10>
                <tr align="left">
                    <td colspan=2 >
                    <p>Please do not enter actual information<p>
                </td>
                </tr>
                <tr>
                    <td>Name on Card:</td>
                    <td><?php echo $_POST['full_name']?></td>
                    <input type='hidden' name='full_name' value= <?php echo $_POST['full_name'] ?> />
                </tr>
                <tr>
                    <td>Card Number:</td>
                    <td><?php echo $_POST['card_no']?></td>
                    <input type='hidden' name='card_no' value= <?php echo $_POST['card_no'] ?> />
                </tr>
                <tr>
                    <td>Expiration Date:</td>
                    <td><?php echo $_POST['exp_date']?></td>
                    <input type='hidden' name='exp_date' value= <?php echo $_POST['exp_date'] ?> />
                </tr>
                <tr>
                    <td>CID:</td>
                    <td><?php echo $_POST['cid']?></td>
                    <input type='hidden' name='cid' value= <?php echo $_POST['cid'] ?> />
                </tr>
                <tr>
                    <td>Amount:</td>
                    <td>$<?php echo number_format($_POST['total'],2) ?></td>
                    <input type='hidden' name='total' value= <?php echo $_POST['total'] ?> />
                </tr>   
                <tr>
                    <td></td>
                    <td><input type='submit' value="Checkout" /></form></td>
                </tr>
                <tr>
                    <td></td>
                    <td><form action='cart.php' method='post'><input type='submit' value="Go Back" /></form></td>
                </tr>
            </table>
        	
        </div>

</html>

