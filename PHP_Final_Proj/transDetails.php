<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - transDetails.php

This page displays specific information of one transaction
(items purchased, quatnity, etc.)
-->

<html>
<head>
<title>Transaction History</title>
</head>

<?php 
	session_start();
    include_once 'includes\functionsIncluded.php';
	if (loggedin()):
		include_once 'admin_navigation.php'; 
	$rec_num=$_GET['rec'];

	get_rec($rec_num); //display information for a specific transaction
 ?>

	<div id="formLeft"> 

		<h2>Find Transactions:</h2>
		
		<?php
			$trans_no=NULL;
		    $start_date=NULL;
            $end_date=NULL; 
            $customers=NULL;
            if(isset($_POST['trans_no'])) {
                $trans_no=$_POST['trans_no'];
            }
            if(isset($_POST['start_date'])) {
                $start_date=$_POST['start_date'];                
            }
            if(isset($_POST['end_date'])) {
                $end_date=$_POST['end_date'];
            }
            if(isset($_POST['customers'])) {
                $customers=$_POST['customers'];
            }
            //call get_transactions() to print out selected transaction
            get_transactions($trans_no, $start_date, $end_date, $customers); 
		?>
	</div>
	<div id="right_side">
		<h2>Criteria Search</h2>
        <!-- Create form to accept search criteria -->
        <form action='' method='post'>
            <table align="center" style="margin: 0px auto;" cellpadding=10>
                <tr align="left">
                    <td colspan=2 >
                    <p>Enter data to filter customers <p>
                    <p>Leave blank to find all. </p>  <!-- Information must match exactly. No like searches programmed. -->  
                </td>
                </tr>
                <tr>
                    <td>Receipt Number:</td>
                    <td><input type='number' name='trans_no' value="<?php if(isset($_POST['trans_no'])) echo $_POST['trans_no']; ?>"/></td>
                </tr>
                <tr>
                    <td>Transaction Date Range Start:</td>
                    <td><input type='date' name='start_date' value="<?php if(isset($_POST['start_date'])) echo $_POST['start_date']; ?>" /></td>
                </tr>
                <tr>
                    <td>Transaction Date Range End:</td>
                    <td><input type='date' name='end_date' value="<?php if(isset($_POST['end_date'])) echo $_POST['end_date']; ?>" /></td>
                </tr>
                <tr>
                    <td>Customer Full Name:</td>
                    <td><input type='text' name='customers' value="<?php if(isset($_POST['customers'])) echo $_POST['customers']; ?>" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type='submit' value="Search" /></td>
                </tr>
            </table>
        </form>
	</div>
<?php endif; ?>

</html>