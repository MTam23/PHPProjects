<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - catalog.php

This page displays all the current available items.
-->
<?php 
	session_start();
	include_once 'includes\functionsIncluded.php';
	include_once 'customer_navigation.php'; 
 ?>
<html>
<head>
<title>Catalog</title>
</head>
	<div id="formStyle"> 
		<h2>Items:</h2>
		<?php
			get_items(TRUE); //call get_items() to print out selected items
        ?>
    </div>
</html>

