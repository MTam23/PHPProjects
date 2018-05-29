<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - customer_navigation.php

This page creates the header and navigation buttons for the customer pages.
It also includes style information.
-->

<head>
<title>PHP Final Project eStore</title>
<div id="header">
<h><a href="customer_portal.php">PHP eSTORE</a></h>
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
    background-color:lightblue;
    color:white;
}
#butStyle {
    background-color:lightblue;
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
#formStyle input[type='submit']:hover {
    color: #FFFFFF;
    background: blue;
}
#container {
    white-space:nowrap;
    text-align:center;
}
#formLeft {
    background-color:white;
    color:black;
    text-align:center;
    padding:50px;
    white-space:nowrap;
    width:500px;
    margin-left:100px;
    float:left;
}
#right_side {
    line-height:30px;
    height:300px;
    width:500px;
    white-space:nowrap;
    padding:50px;
    margin-right:100px;
    float:right;

}

</style>

<!--Creates the buttons in the header to navigate the site-->
<div id="butStyle"> 
    <a href="catalog.php"><input type='submit' value='Browse Items'></a>
    <a href="Cart.php"><input type='submit' value='Your Cart'></a>
    <a href="Checkout.php"><input type='submit' value='Checkout'></a>
</div>
<hr>
</body>