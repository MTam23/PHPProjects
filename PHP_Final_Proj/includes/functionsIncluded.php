<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - functionsIncluded.php
	
	This file will hold all functions that need to be included.
-->

<!--VALIDATE_USER($USERNAME, $PASSWORD)
    Function validate_user takes a username and password, then
    returns TRUE if they match with an existing entry in the 
    database and FALSE if they don't
-->

<?php
    function validate_user($u_name, $pwd) {

    include_once("includes/view_config.php");
    $table="user_information";
    

        //get the password hash stored in the MySQL table user_information
        $sql = "SELECT pass FROM $table WHERE user_name='$u_name'";
        $hash=mysqli_query($conn,$sql);
        
        if (mysqli_num_rows($hash) != 1) {
            //if the entry could not be found, the username does not exist.
            
            mysqli_close($conn);
            return FALSE;
        } else {
            //check if the password matches and return that result      
            $string=mysqli_fetch_row($hash)[0];
            mysqli_close($conn);
            return password_verify($pwd, $string);
        }
    
    }
?>

<!--VALIDATE_PASSWORD($PASSWORD)
    A password will be defined as strong if it matches the following criteria:
        -Contains least 8 characters
        -Contains at least one character from each of the following groups:
                -Uppercase Letters (A-Z)
                -Lowercase Letters (a-z)
                -Number (0-9)

    Function validate_password takes a string ($pw) and returns true or false if
    the string can be used as a strong password.
-->
<?php
    function validate_password ($pw) {
        $regex = '^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,}';
        if (preg_match('/'.$regex.'/', $pw)){
            //if fulfills the criteria, return TRUE
            return TRUE;
        } else {
            //if does not fulfill the criteria, return FALSE
            return FALSE;
        }
    }

?>


<!--ABSOUTE_URL($page))
    Function absolute_url takes the page that concludes the URL and determins and returns an
    absolute URL
-->
<?php
    function absolute_url($page='admin_portal.php') {
        $url = 'http://' . $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
        $url = rtrim($url, '/\\');
        $url .= '/' . $page;
        return $url;
    } 
?>

<!--loggedin()
    If a user is logged, return true. If not, redirect them to the home page (enhanced_web_based_registration.php)
-->
<?php
    function loggedin() {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in']) || $_SESSION['logged_in']==false
            || !isset($_SESSION['agent']) || $_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT'])):
            $_SESSION['logged_in'] = false;
            // Redirect:
            $url = absolute_url ('admin_portal.php');
            header("Location: $url");
            exit();
        else:
            return true;
        endif;
    }
?>


<!--get_transactions($trans_no, $start_date, $end_date, $customer, $receipt)
    This pulls all transactions in the trans table. If parameters are sent, it will filter the transactions displayed.
    
-->
<?php

    function get_transactions($trans_no=null, $start_date=null, $end_date=null, $customer=null, $receipt=FALSE) {
        
        include("includes/view_config.php");
        $table="trans";

        $sql = "SELECT receipt_no as 'Receipt Number', full_name as 'Customer Name', day as 'Date', amount as 'Amount' FROM `$table` WHERE 1";
        if ($start_date!=NULL) {
            if ($end_date!=NULL) {
                $sql=$sql." AND day BETWEEN '$start_date' AND '$end_date'";
            } else {
                $sql=$sql." AND day='$start_date'";
            }

        }
        if($customer!=NULL) {
            $sql=$sql." AND full_name='$customer'";
        }
        if($trans_no!=NULL) {
            $sql=$sql." AND receipt_no='$trans_no'";
        }

        $result = mysqli_query($conn, $sql);

        //verify that the table has entries
        if ($result!=FALSE and mysqli_num_rows($result) > 0) {     
            //if it does, output those entries.
            echo "<table align='center' style='margin:0px auto;' cellpadding=10 border=1>";

            echo "<tr>";
            while($col = mysqli_fetch_field($result)) {
                $name = ucwords(str_replace("_", " ", $col->name));
                echo "<td><strong>$name</strong></td>";
            }
            echo "<td><strong>Items</strong></td>";
            echo "</tr>";

            while($row = mysqli_fetch_row($result)) { 
            // for each table,loop through the table rows and output
                echo "<tr>"; 
                $col=0;
                $rec_temp=NULL;
                foreach($row as $entry) {
                    echo "<td>$entry</td>";
                    if($col==0) {
                        $rec_temp=$entry;
                    }
                    if($col==3){
                        if ($receipt) {
                            echo "<td><a href=custTransDetails.php?rec=$rec_temp>Details</a></td>";    
                        } else {
                            echo "<td><a href=transDetails.php?rec=$rec_temp>Details</a></td>";    
                        }
                    }
                    $col++;

                }
                echo "</tr>"; 
            } 
            echo "</table><br>"; 
        } else { 
            //otherwise, let the user know no entries are in the table
            echo "No transactions found."; 
        }
        echo "</td>";
        echo "</tr>";   
    
        echo "</table>";
        mysqli_close($conn);
        if($receipt) {
            return TRUE;
        }
    }
?>

<!--get_rec($rec_num)
    This pulls transaction information for a specific receipt number.    
-->
<?php

    function get_rec($rec_num) {
        
        include_once("includes/view_config.php");
        $table="trans";
        $table2="transdetails";
        $table3="items";

        //create the table for the information
        echo "<table align='center' style='margin:0px auto;' cellpadding=10>";
        echo "<tr>";
        echo "<td>";
        echo "<h3>Transaction: " . $rec_num . "</h3>";

        $sql = "SELECT receipt_no as 'Receipt Number', full_name as 'Customer Name', day as 'Date', amount as 'Amount' FROM `$table` WHERE receipt_no=" . $rec_num;
       

        $result = mysqli_query($conn, $sql);

        //verify that the table has entries
        if ($result!=FALSE and mysqli_num_rows($result) > 0) {     
            //if it does, output those entries.
            echo "<table align='center' style='margin:0px auto;' cellpadding=10 border=1>";

            echo "<tr>";
            while($col = mysqli_fetch_field($result)) {
                $name = ucwords(str_replace("_", " ", $col->name));
                echo "<td><strong>$name</strong></td>";
            }
            while($row = mysqli_fetch_row($result)) { 
            // for each table,loop through the table rows and output
                echo "<tr>"; 
                foreach($row as $entry) {
                    echo "<td>$entry</td>";
                }
                echo "</tr>"; 
            } 
            echo "</table><br>"; 
        } else { 
            //otherwise, let the user know no entries are in the table
            echo "Transaction not found."; 
        }
        echo "</td>";
        echo "</tr>";   
        echo "</table>";
        $sql2="SELECT item_no AS 'Item', item_quant AS 'Quantity', item_description AS 'Description' FROM $table2 JOIN $table3 ON item_code=item_no WHERE trans_no=" . $rec_num;

        $result2 = mysqli_query($conn, $sql2);
        //verify that the table has entries
        if ($result!=FALSE and mysqli_num_rows($result) > 0) {     
            //if it does, output those entries.
            echo "<table align='center' style='margin:0px auto;' cellpadding=10 border=1>";

            echo "<tr>";
            while($col = mysqli_fetch_field($result2)) {
                $name = ucwords(str_replace("_", " ", $col->name));
                echo "<td><strong>$name</strong></td>";
            }
            echo "</tr>";

            while($row = mysqli_fetch_row($result2)) { 
            // for each table,loop through the table rows and output
                echo "<tr>"; 
                $col=0;
                $rec_temp=NULL;
                foreach($row as $entry) {
                    echo "<td>$entry</td>";
                }
                echo "</tr>"; 
            } 
            echo "</table><br>"; 
        } else { 
            //otherwise, let the user know no entries are in the table
            echo "Transaction not found."; 
        }
        echo "</td></tr></table>";

        mysqli_close($conn);
    }
?>

<!--get_users()
    Function get_users prints out all registered users in the database
    This is printed out as an html table.
-->
<?php

    function get_users() {
        
        include_once("includes/view_config.php");
        $table="user_information";

        //create the table for the information
        echo "<table align='center' style='margin:0px auto;' cellpadding=10>";
        echo "<tr>";
        echo "<td>";
        echo "<h3>Users:</h3>";

        $sql = "SELECT user_name, last_name, first_name FROM `$table` WHERE 1";
        
        $result = mysqli_query($conn, $sql);
        
        //verify that the table has entries
        if ($result!=FALSE and mysqli_num_rows($result) > 0) {     
            //if it does, output those entries.
            echo "<table align='center' style='margin:0px auto;' cellpadding=10 border=1>";

            echo "<tr>";
            while($col = mysqli_fetch_field($result)) {
                $name = ucwords(str_replace("_", " ", $col->name));
                echo "<td><strong>$name</strong></td>";
            }
            echo "</tr>";

            while($row = mysqli_fetch_row($result)) { 
            // for each table,loop through the table rows and output
                echo "<tr>"; 
                foreach($row as &$entry) {
                    echo "<td>$entry</td>";
                }
                echo "</tr>"; 
            } 
            echo "</table><br>"; 
        } else { 
            //otherwise, let the user know no entries are in the table
            echo "No Users."; 
        }
        echo "</td>";
        echo "</tr>";
    echo "</table>";
    mysqli_close($conn);
    }
?>


<!--get_items($cust)
    Function get_items prints out all items in the database.
    If $cust is TRUE, another column will be created allowing customers to add items.
    This is printed out as an html table.
-->
<?php

    function get_items($cust=NULL) {
        //connection info
        include_once("includes/view_config.php");
        $table="items";

        //create the table for the information
        echo "<table align='center' style='margin:0px auto;' cellpadding=10>";
        echo "<tr>";
        echo "<td>";
        echo "<h3>Items:</h3>";

        $sql = "SELECT * FROM `$table` WHERE 1";
        
        $result = mysqli_query($conn, $sql);
        
        //verify that the table has entries
        if ($result!=FALSE and mysqli_num_rows($result) > 0) {     
            //if it does, output those entries.
            echo "<table align='center' style='margin:0px auto;' cellpadding=10 border=1>";

            echo "<tr>";
            while($col = mysqli_fetch_field($result)) {
                $name = ucwords(str_replace("_", " ", $col->name));
                echo "<td><strong>$name</strong></td>";
            }
            if ($cust) {
                echo "<td></td>";
            }
            echo "</tr>";

            $item_co=NULL;
            while($row = mysqli_fetch_row($result)) { 
            // for each table,loop through the table rows and output
                echo "<tr>"; 

                $count=0;
                foreach($row as $entry) {
                    echo "<td>$entry</td>";
                    if($count==0) {
                        $item_co=$entry;
                    }
                    $count+=1;
                }
                //if being accessed by a customer, allow them to add an item
                if($cust) {
                    ?>
                    <td>
                        <a href="add_One.php?item=<?php echo $item_co?>">Add to Cart</a>
                    </td>

                    <?php
                }
                echo "</tr>"; 
            } 
            echo "</table><br>"; 

        } else { 
            //otherwise, let the user know no entries are in the table
            echo "No Items."; 
        }
        echo "</td>";
        echo "</tr>";
    echo "</table>";
    mysqli_close($conn);
    }
?>

<!--add_items($item_code, $desc, $amount)
    Function add_items() adds an item to the items table
-->
<?php

    function add_items($item_code, $desc, $amount) {
        //connection info
        include_once("includes/edit_config.php");
        $table="items";

        $sql = "INSERT INTO $table (`item_code`, `item_description`, `amount`) VALUES ('$item_code', '$desc', '$amount')";
        if (mysqli_query($conn, $sql)) {
            echo "Item Added";
        } else {
            echo "Error adding record: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
?>


<!--edit_items($item_code, $desc, $amount)
    Function edit_items() edits an item ($item_code) in the items table
-->
<?php

    function edit_items($item_code, $desc, $amount) {
        //connection info
        include_once("includes/edit_config.php");
        $table="items";

        $sql = "UPDATE $table SET";

        if ($desc != NULL) {
            $sql .= " item_description = '$desc'";
            if ($amount !=NULL || $inv != NULL) {
                $sql .=",";
            }
        }
        if ($amount !=NULL) {
            $sql .= " amount = '$amount'";
            if ($inv != NULL) {
                $sql .=",";
            }
        }

        $sql .= " WHERE item_code='$item_code'";

        if (mysqli_query($conn, $sql)) {
            echo "Item edited successfully.";
        } else {
            echo "Error editing item.";
        }
        mysqli_close($conn);

    }
?>

<!--del_items($item_code)
    Function del_items() deletes an item from the items table
-->
<?php

    function del_items($item_code) {
        
        include_once("includes/edit_config.php");
        $table="items";

        $sql = "SELECT item_code FROM $table WHERE item_code=$item_code";
        $result = mysqli_query($conn, $sql);
        if($result == FALSE || mysqli_num_rows($result)==1) {
           $sql2 = "DELETE FROM `$table` WHERE item_code = $item_code";
       
            if (mysqli_query($conn, $sql2)) {
                echo "Record Deleted";
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }
        } else {
            echo "Error deleting record. Record not found.";
        }
           
    mysqli_close($conn);
    }
?>


<!--add_users($user_name, $pass, $fname, $lname)
    Function add_users() creates another user that can log in to the admin portal.
-->
<?php

    function add_user($user_name, $pass, $fname, $lname) {
       
        include("includes/edit_config.php");
        $table="user_information";

        $pwd = password_hash($pass, PASSWORD_BCRYPT);

        $sql = "INSERT INTO $table (`user_name`, `pass`, `first_name`, `last_name`) VALUES ('$user_name', '$pwd', '$fname', '$lname')";
        if (mysqli_query($conn, $sql)) {
            echo "User Added";
        } else {
            echo "Error adding user: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
?>


<!--edit_items($user_name, $pass, $fname, $lname)
    Function edit_user edits an existing user's information
    User TEST cannot be edited.
-->
<?php

    function edit_user($user_name, $pass, $fname, $lname) {
        if (strtolower($user_name) != "test") {
            include("includes/edit_config.php");
            $table="user_information";

            $sql = "UPDATE $table SET";

            if ($pass != NULL) {
                $pwd = password_hash($pass, PASSWORD_BCRYPT);
                $sql .= " pass = '$pwd'";
                if ($fname !=NULL || $lname != NULL) {
                    $sql .=",";
                }
            }
            if ($fname !=NULL) {
                $sql .= " first_name = '$fname'";
                if ($lname != NULL) {
                    $sql .=",";
                }
            }
            if ($lname !=NULL) {
                $sql .= " last_name = '$lname'";
            }

            $sql .= " WHERE user_name='$user_name'";

            if (mysqli_query($conn, $sql)) {
                echo "User edited successfully.";
            } else {
                echo "Error editing user.";
            }
             mysqli_close($conn);
        } else {
            echo "Cannot edit that user.";
        }     
    }
?>

<!--del_user($user_name)
    Function del_user delets an existing user's information
    User TEST cannot be edited.
-->
<?php

    function del_user($user_name) {
        
        include("includes/edit_config.php");
        $table="user_information";

        if ($user_name!="test") {
            $sql = "SELECT user_name FROM `$table` WHERE user_name='$user_name'";
            $result = mysqli_query($conn, $sql);
            if($result == FALSE || mysqli_num_rows($result)==1) {
                $sql2 = "DELETE FROM `$table` WHERE user_name = '$user_name'";
           
                if (mysqli_query($conn, $sql2)) {
                    echo "User Deleted";
                } else {
                    echo "Error deleting user: " . mysqli_error($conn);
                }
            } else {
                    echo "Error deleting user.";
                }
        } else {
            echo "Cannot delete that user.";
        }
    mysqli_close($conn);
    }
?>

<!--show_cart($del)
    show_cart() displays current contents of cart and returns total or false if no items.
-->
<?php

    function show_cart($del=TRUE) {
        //perform checks to see if the cart has been initialized and if the quantity is > 0
        if (!isset($_SESSION['my_Cart'])) {
            return FALSE;
        }
        $q=0;
        foreach($_SESSION['my_Cart'] as $item => $quant) {
            $q+=$quant;
        }
        if($q==0) {
            return FALSE;
        }

        include_once("includes/view_config.php");
        $table='items';

        //create the table for the information

        echo "<table align='center' style='margin:0px auto;' cellpadding=10 border=1>";

        echo "<tr>";

        $sql = "SELECT item_code, item_description, amount FROM `$table` WHERE 1";
        
        $result = mysqli_query($conn, $sql);
        
        //verify that the table has entries
        if ($result!=FALSE and mysqli_num_rows($result) > 0) {     
            //if it does, output those entries.
            
            while($col = mysqli_fetch_field($result)) {
                $name = ucwords(str_replace("_", " ", $col->name));
                echo "<td><strong>$name</strong></td>";    
            }
            echo "<td><strong>Quantity</strong></td>";
            

            echo "</tr>";
            $total=0;
            while($row = mysqli_fetch_row($result)) { 
            // for each entry,loop through the table rows and output
                echo "<tr>"; 
                $count=0;
                $item_temp=NULL;
                foreach($row as $entry) {
                    if($count==0) {
                        $item_temp=$entry;
                    }
                    if(!isset($_SESSION['my_Cart'][$item_temp])||$_SESSION['my_Cart'][$item_temp]!=0) {

                        echo "<td>$entry</td>";
                        
                        if($count==2) {
                            echo '<td>';
                            if(!isset($_SESSION['my_Cart'][$item_temp])) {
                                $_SESSION['my_Cart'][$item_temp]=0;
                            }
                            echo $_SESSION['my_Cart'][$item_temp];
                            $total+=$entry*$_SESSION['my_Cart'][$item_temp];
                            echo "</td>";
                            if($del) {
                                echo "<td><a href='delete.php?id=$item_temp'>Delete</a></td>";
                            }
                        }
                    }
                    $count++;
                }
                echo "</tr>";
            }
            echo "</table>";
            mysqli_close($conn);
            //return the cart's total cost
            return $total;

        } else { 
            //otherwise, let the user know no entries are in the table
            echo "No Items."; 
            mysqli_close($conn);
            return FALSE;
        }
    }
    
?>

<!--validate_card($name, $card_no, $exp, $cid, $total)
    validate_card() would check and confirm all information with card processor.
    Here it only checks to see if the card matches test info.
    Returns true if it does. Else returns false
        
-->
<?php

    function validate_card($name, $card_no, $exp, $cid, $total) {
        if ($name!=null && $card_no=='5454545454545454' && strtotime($exp) > strtotime(date("Y-m")) && $cid!=null && $total > 0) {
            return true;
        } else {
            return false;
        }
    }

?>  

<!--commit_transaction($name, $card_no, $exp, $cid, $total)
    commit_transaction() adds a transaction to database and returns the receipt number        
-->
<?php
    function commit_transaction($name, $card_no, $exp, $cid, $total) {
        include_once("includes/edit_config.php");
        $table="trans";
        $table2="transdetails";

        //configure date before inserting into database.
        $exp_date=date('Y-m-d', strtotime($exp));

        $sql = "INSERT INTO `$table` (`receipt_no`, `day`, `amount`, `card_no`, `exp_date`, `cid`, `full_name`) VALUES (NULL, '". date('Y-m-d')."', '$total', '$card_no', '$exp_date', '$cid', '$name')";

        $result = mysqli_query($conn, $sql);
        
        //verify that the table has entries
        if ($result!=FALSE) {     

            $sql_rec= "SELECT max(`receipt_no`) FROM $table";
            $result_rec=mysqli_query($conn, $sql_rec);
            $rec_num=mysqli_fetch_row($result_rec)[0];

            foreach($_SESSION['my_Cart'] as $item => $quantity) {
                if ($quantity !=0) {
                    $sql2 = "INSERT INTO `$table2` (`item_no`, `item_quant`, `trans_no`) VALUES ('$item', '$quantity', '$rec_num')";
                    mysqli_query($conn, $sql2);           
                }
            }
            mysqli_close($conn);
            //send receipt number
            return $rec_num;
           
        } else { 
            mysqli_close($conn);
            return FALSE;
        }
        mysqli_close($conn);
        return FALSE;  
    }

?>