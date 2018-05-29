<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - users.php

This page displays information about currently created users and allows edits to any
that are not the built in Test user.
-->



<html>
<head>
<title>User Setup</title>
</head>

<?php include_once 'includes\functionsIncluded.php';
	session_start();
	if (loggedin()):
		include_once 'admin_navigation.php'; 
 ?>

	<div id="formLeft"> 
		<?php
			if (isset($_POST['userAction_add'])) {
				if (isset($_POST['user_name_add']) &&
					isset($_POST['pass_add']) &&
					isset($_POST['fname_add']) &&
					isset($_POST['lname_add'])) {
						if (validate_password($_POST['pass_add'])) {
                            //add a user
							add_user($_POST['user_name_add'], $_POST['pass_add'], $_POST['fname_add'], $_POST['lname_add']);
						} else {
							echo "<p>Password is invalid. </p>";
						}
						
						unset ($_POST['userAction_add']);
				} else {
					echo "<h2>Error adding user.<h2>";
				}
			} elseif(isset($_POST['userAction_edit'])) {
				if (isset($_POST['user_name_edit']) &&
					(isset($_POST['pass_edit']) ||
					isset($_POST['fname_edit']) ||
					isset($_POST['lname_edit']))) {
                        //edit user information                    
						edit_user($_POST['user_name_edit'], $_POST['pass_edit'], $_POST['fname_edit'], $_POST['lname_edit']);
						unset($_POST['userAction_edit']);
				} else {
					echo "<h2>Error editing user.<h2>";
				}			
			} elseif(isset($_POST['userAction_del'])) {
				if (isset($_POST['user_name_del'])) {
                    //delete a user
					del_user($_POST['user_name_del']);
					unset ($_POST['userAction_del']);
				} else {
					echo "<h2>Error deleting user.<h2>";
				}
			}
		   	get_users(); //call get_users() to print out users.

        ?>
        </div>

        <!-- Create forms to get user information to edit, add, or delete -->
        <div id="right_side">
        	<h2>Add a User</h2>
        <form action='' method='post'>
            <table align="center" style="margin: 0px auto;" cellpadding=10>
                <tr align="left">
                    <td colspan=2 >
                    <p>Enter all information to add a user.</p>
                    <p>Lists must:
                    <ul>
                    	<li>Contain least 8 characters</li>
                    	<li>Contain at least one character from each of the following groups:</li>
                    	<ul>
                    		<li>Uppercase Letters (A-Z)</li>
                    		<li>Lowercase Letters (a-z)</li>
                    		<li>Number (0-9)</li>
                    	</ul>
                    </ul>
                </td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td><input type='text' name='user_name_add' required /></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type='password' name='pass_add' required /></td>
                </tr>
                <tr>
                    <td>First Name:</td>
                    <td><input type='text' name='fname_add' required /></td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type='text' name='lname_add' required /></td>
                </tr>
                <tr>
                    <td><input type='hidden' name='userAction_add' /></td>
                    <td><input type='submit' value="Submit" /></td>
                </tr>
            </table>
        </form>

		<h2>Edit a User</h2>
       	<form action='' method='post'>
            <table align="center" style="margin: 0px auto;" cellpadding=10>
                <tr align="left">
                    <td colspan=2 >
                    <p>Leave a field blank to leave unchanged.<p>
                </td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td><input type='text' name='user_name_edit' /></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type='password' name='pass_edit' /></td>
                </tr>
                <tr>
                    <td>First Name:</td>
                    <td><input type='text' name='fname_edit' /></td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type='text' name='lname_edit' /></td>
                </tr>
                <tr>
                	<td><input type='hidden' name='userAction_edit' /></td>
                    <td><input type='submit' value="Submit" /></td>
                </tr>

            </table>
        </form>

		<h2>Delete a User</h2>
       	<form action='' method='post'>
            <table align="center" style="margin: 0px auto;" cellpadding=10>
                <tr align="left">
                    <td colspan=2 >
                </td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td><input type='text' name='user_name_del' required /></td>
                </tr>
                <tr>
                	<td><input type='hidden' name='userAction_del' /></td>
                    <td><input type='submit' value="Delete" /></td>
                </tr>

            </table>
        </form>
        </div>

<?php endif; ?>
</html>

