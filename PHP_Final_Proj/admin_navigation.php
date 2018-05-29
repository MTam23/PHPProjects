<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - admin_navigation.php

This page creates the header and navigation buttons for the admin pages.
It also includes style information.
-->
<?php include_once 'includes\functionsIncluded.php';?>


<head>
<title>PHP Final Project eStore</title>
<div id="header">
<h><a href="admin_portal.php">PHP eSTORE</a></h>
</div>
</head>
<body>
<style>
a:link {
    color:black;
    background-color:transparent;
    text-decoration:none;
}
a:visited {
    color:black;
    background-color:transparent;
    text-decoration:none;
}
a:hover {
    color:blue;
    background-color:transparent;
    text-decoration:underline;
}
a:active {
    color:blue;
    background-color:transparent;
    text-decoration:underline;
}
#header {
    text-align:center;
    padding:25px;
    font-size:55px;
    background-color:darkgrey;
    color:white;
}
#butStyle {
    background-color:darkgrey;
    color:black;
    text-align:center;
    padding:50px;
}
#formStyle {
    background-color:white;
    color:black;
    text-align:center;
    padding:50px;
}
#formLeft {
    background-color:white;
    color:black;
    text-align:center;
    padding:50px;
    float:left;
    width:500px;
    margin-left:100px;
}
#right_side {
    line-height:30px;
    height:300px;
    width:500px;
    float:right;
    padding:50px;
    margin-right:100px;
}
</style>

<!--Creates the buttons in the header to navigate the site if logged in-->
<div id="butStyle"> 
    <?php if(isset($_SESSION['user_id'])&&$_SESSION['logged_in'] == TRUE):?>
    <a href="Transaction_history.php"><input type='submit' value='Find Transactions'></a>
    <a href="Item_Setup.php"><input type='submit' value='Edit Items'></a>
    <a href="Users.php"><input type='submit' value='Administator Accounts'></a>
    <a href="admin_logout.php"><input type='submit' value='Log Out'></a>
    <?php endif; ?>
</div>
<hr>
</body>