<?php 
include 'model/admin_editFunc.php';

//prepare data
$admin_edit_manager = new adminEditFunction();

$id = $_GET['id'];

if (isset($_POST['edit'])) {
    //show the pre-filled answer
    $edited_username = $_POST['username'];
    $edited_email = $_POST['email']; 
    $edited_firstname = $_POST['first_name']; 
    $edited_lastname = $_POST['last_name']; 
    $edited_admin = $_POST['admin']; 
    $admin_edit_manager -> editEntry($id, $edited_username, $edited_email, $edited_firstname, $edited_lastname, $edited_admin);
}

$user = $admin_edit_manager->showEntry($id);
include 'view/adminEditView.php';