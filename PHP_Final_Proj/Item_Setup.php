<!-- Creation Date: 9/25/2015
    Creator: Michael Tam
    Purpose: ELENGX400-002 PHP Programming for the Web
            Programming Final Project - item_setup.php

This page allows admins to view, add, delete, and configure items.
-->



<html>
<head>
<title>Item Setup</title>
</head>

<?php 
	session_start();
    include_once 'includes\functionsIncluded.php';
	if (loggedin()):
		include_once 'admin_navigation.php'; 
 ?>

	<div id="formLeft"> 
		<h2>Item Setup:</h2>
		<?php
			if (isset($_POST['itemAction_add'])) {
				if (isset($_POST['item_code_add']) &&
					isset($_POST['description_add']) &&
					isset($_POST['amount_add'])) {
                        //if an item is to be added, call add_items() to do so
						add_items($_POST['item_code_add'], $_POST['description_add'], $_POST['amount_add']);
						unset ($_POST['itemAction_add']);
				} else {
					echo "<h2>Error adding item.<h2>";
				}
			} elseif(isset($_POST['itemAction_edit'])) {
				if (isset($_POST['item_code_edit']) &&
					(isset($_POST['description_edit']) ||
					isset($_POST['amount_edit']))) {
                        //if an item is to be edited, call edit_items() to do so
						edit_items($_POST['item_code_edit'], $_POST['description_edit'], $_POST['amount_edit']);
						unset($_POST['itemAction_edit']);
				} else {
					echo "<h2>Error editing item.<h2>";
				}			
			} elseif(isset($_POST['itemAction_del'])) {
				if (isset($_POST['item_code_del'])) {
                    //if an item is to be deleted, call del_items() to do so
					del_items($_POST['item_code_del']);
					unset ($_POST['itemAction_del']);
				} else {
					echo "<h2>Error deleting item.<h2>";
				}
			}

		    get_items(); //call get_items() to print out items

        ?>
    </div>
<!--Create forms to get information to add, edit, or delete items -->
    <div id="right_side">
        <h2>Add Item</h2>
        <form action='' method='post'>
            <table align="center" style="margin: 0px auto;" cellpadding=10>
                <tr align="left">
                    <td colspan=2 >
                    <p>Enter all information to add an item.<p>
                </td>
                </tr>
                <tr>
                    <td>Item_code (number):</td>
                    <td><input type='number' name='item_code_add' value="<?php if(isset($_POST['item_code_add'])) echo $_POST['item_code_add']; ?>" required /></td>
                </tr>
                <tr>
                    <td>Item Description:</td>
                    <td><textarea cols="30" rows="4" name="description_add" value="<?php if(isset($_POST['description_add'])) echo $_POST['description_add']; ?>" required /></textarea></td>
                </tr>
                <tr>
                    <td>Amount per item:</td>
                    <td><input type='number' name='amount_add' value="<?php if(isset($_POST['amount_add'])) echo $_POST['amount_add']; ?>" required /></td>
                </tr>
                <tr>
                    <td><input type='hidden' name='itemAction_add' /></td>
                    <td><input type='submit' value="Submit" /></td>
                </tr>
            </table>
        </form>

		<h2>Edit Existing Item</h2>
       	<form action='' method='post'>
            <table align="center" style="margin: 0px auto;" cellpadding=10>
                <tr align="left">
                    <td colspan=2 >
                    <p>Leave a field blank to leave unchanged.<p>
                </td>
                </tr>
                <tr>
                    <td>Item_code (number):</td>
                    <td><input type='number' name='item_code_edit' value="<?php if(isset($_POST['item_code_edit'])) echo $_POST['item_code_edit']; ?>" required /></td>
                </tr>
                <tr>
                    <td>Item Description:</td>
                    <td><textarea cols="30" rows="4" name="description_edit" value="<?php if(isset($_POST['description_edit'])) echo $_POST['description_edit']; ?>"/></textarea></td>
                </tr>
                <tr>
                    <td>Amount per item:</td>
                    <td><input type='number' name='amount_edit' value="<?php if(isset($_POST['amount_edit'])) echo $_POST['amount_edit']; ?>"/></td>
                </tr>
                <tr>
                	<td><input type='hidden' name='itemAction_edit' /></td>
                    <td><input type='submit' value="Submit" /></td>
                </tr>

            </table>
        </form>

		<h2>Delete an Existing Item</h2>
       	<form action='' method='post'>
            <table align="center" style="margin: 0px auto;" cellpadding=10>
                <tr align="left">
                    <td colspan=2 >
                    <p>Leave a field blank to leave unchanged.<p>
                </td>
                </tr>
                <tr>
                    <td>Item_code (number):</td>
                    <td><input type='number' name='item_code_del' value="<?php if(isset($_POST['item_code_del'])) echo $_POST['item_code_del']; ?>" required /></td>
                </tr>
                <tr>
                	<td><input type='hidden' name='itemAction_del' /></td>
                    <td><input type='submit' value="Delete" /></td>
                </tr>

            </table>
        </form>

        </div>

<?php endif; ?>
</html>

