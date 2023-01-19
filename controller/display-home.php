<?php
include 'controllerHelper.php';

if ($_SESSION['logged_in']) {
    include 'view/home.php';
<<<<<<< HEAD
// } else {
    // include 'view/landingView.php';
// }


//ASK USER FOR LOCATION
//GET THEIR CO_ORDINATES
//LOOP THROUGH PLACES 
//FOR EACH PLACE CHECK IF IT IS IN XYZ RADIUS
//RETURN LIST OF PLACES
//
=======
} else {
    include 'view/landingView.php';
}
>>>>>>> 6ab4aaa751e32196e6f46da635831ba5e6537e0e
