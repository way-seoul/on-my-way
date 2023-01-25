<?php
include 'controllerHelper.php';

if (isset($_SESSION['logged_in'])) {
    // redirect instead of include?
    include 'view/home.php';
    print_r($_SESSION);
} else {
    // redirect instead of include?
    include 'view/landingView.php';
    print_r($_SESSION);
}
