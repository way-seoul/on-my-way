<?php
include 'controllerHelper.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    include 'view/home.php';
    die();
} else {
    include 'view/landingView.php';
}
