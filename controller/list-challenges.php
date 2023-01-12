<?php

require_once 'model/challengeManager.php';
require_once 'model/placeManager.php';

$c_manager = new ChallengeManager();
$p_manager = new PlaceManager();
$places = $c_manager->getPlaces();

if(isset($_POST['delete']) && $_POST['delete']!= '') {
    $c_manager->deleteChallenge($_POST['delete']);
} 
if(isset($_POST['edit'])) {
    $challengeId = $_POST['edit'];
    $challengeData = $c_manager->getChallengeData($challengeId);
    //Pull list of existing places from DB for user to select from
    $existingPlaces = $p_manager->retrievePlaces();
    $action = 'edit-challenge';
    $btnText = 'Edit Challenge';
    $name = $challengeData['name'];
    $conditions = $challengeData['conditions'];
    $score = $challengeData['score'];
    $edit_place_id = $challengeData['place_id'];
    $backBtn = "<a href='" . $listChallenges_path . "'>Back To Challenges</a>";
    //4 Populate the existing form with data for that place
    require_once 'view/challenge-form.php';
    //Populate forms same as before......
} else {
    require_once 'view/placelistView.php';
}


