<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - receipt.php

This page displays the completed transaction information and commits it to the database.
-->
<?php
    session_start();
    if (!(isset($_POST['full_name'])&&isset($_POST['card_no'])&&isset($_POST['exp_date'])&&isset($_POST['cid'])&&isset($_POST['total']))) {
        header('location:cart.php');
        exit();
    }
    $name=$_POST['full_name'];
    $card_no=$_POST['card_no'];
    $exp=$_POST['exp_date'];
    $cid=$_POST['cid'];
    $total=$_POST['total'];
    include_once 'includes\functionsIncluded.php';
    if (!validate_card($name, $card_no, $exp, $cid, $total)) {
        header('location:trans_failed.php');
        exit();
    }
    include_once 'customer_navigation.php'; 
?>

<html>
<head>
<title>Receipt</title>
</head>
	<div id="formStyle">
	<h2>Receipt:</h2>
	<?php	

        //call commit_transaction() to send info to the database and return a receipt number
        $receipt_num=commit_transaction($name, $card_no, $exp, $cid, $total);


        echo "<table align='center' style='margin:0px auto;' cellpadding=10>";
        echo "<tr>";
        echo "<td>";
        echo "<h3>Your Transaction:</h3>";
		if (get_transactions($receipt_num, NULL, NULL, NULL, TRUE)) {
            unset($_SESSION['my_Cart']);
        }
    ?>
   </div>       
</html>

