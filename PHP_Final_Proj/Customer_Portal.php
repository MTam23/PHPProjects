<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - Customer_Portal.php

This page is the landing page for customers. It goes over some site functionality.
-->



<html>

<head>
<title>CUSTOMER LOGIN - PHP FINAL PROJECT</title>
</head>

<?php include_once 'customer_navigation.php';?>
	<div id="formStyle">
	<table align="center" style="margin:0px auto;" cellpadding=10>
	    <tr align="left">
    	   	<td colspan=2 >
				<h2>Welcome!</h2>
				<h3>Please do not enter actual information into this site.</h3>
				<p>This site has the following functionality:<p>
        			<ul>
			            <li>Registers users (administrators) and allows them to log in.</li>
			            <li>Uses Sessions to track customer cart information.</li>                    
			            <li>Utilizes Databses to store and track transaction and item information</li>
			        </ul>
			</td>
		</tr>
	</table>
	</div>
</html>
