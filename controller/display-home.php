<?php
include 'controllerHelper.php';

if (isset($_POST['login_button']) && $_POST['username'] !== '' && $_POST['password'] !== '') {
    include 'view/home.php';
} else {
    include 'view/landingView.php';
}
