<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - edit_config.php

Has information to connect to the SQL database with editing rights.
-->
<?php

    //connection info
    $servername = "localhost";
    $username = "db_edit";
    $password = "wxRWXZepuAKraxWP";
    $dbname = "phpfinal";


    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>