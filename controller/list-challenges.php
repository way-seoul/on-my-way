<?php

require_once 'model/challengeManager.php';

$c_manager = new ChallengeManager();
$places = $c_manager->getPlaces();

if(isset($_POST['delete']) && $_POST['delete']!= '') {
    $c_manager->deleteChallenge($_POST['delete']);
}


require_once 'view/placelistView.php';
