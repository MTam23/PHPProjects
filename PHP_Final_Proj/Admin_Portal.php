<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - Admin_Portal.php

This page is the landing page for admins. It goes over some site functionality.

-->
<html>
<head>
<title>ADMIN LOGIN - PHP FINAL PROJECT</title>
</head>

<?php
session_start();
include_once 'admin_navigation.php'; ?>
<div id="formStyle"> 
<table align="center" style="margin:0px auto;" cellpadding=10>
    <tr align="left">
        <td colspan=2 >
            <h2>Welcome to the PHP eSTORE Administrative Portal</h2>
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true): ?>
                <h3>You are logged in as: <?php echo $_SESSION['user_id']?></h3>
            <?php else: ?>

                <h3>You are not logged in. Please <a href=admin_login.php><font color="blue">log in</font></a> or <a href=customer_login.php><font color="blue">go to the customer portal</font></a>.</h3>
            <?php endif; ?>
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