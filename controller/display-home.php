<?php
include 'controllerHelper.php';

if ($_SESSION['logged_in']) {
    include 'view/home.php';
} else {
    include 'view/landingView.php';
}
