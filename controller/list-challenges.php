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
    //POPULATE EDIT FORM WITH EXISTING DATA FOR THAT CHALLENGE
    $challengeData = $c_manager->getChallengeData($challengeId);
    $existingPlaces = $p_manager->retrievePlaces();
    $action = 'list-challenges';
    $btnName = 'edit-challenge';
    $btnText = 'Edit Challenge';
    $name = $challengeData['name'];
    $conditions = $challengeData['conditions'];
    $score = $challengeData['score'];
    $edit_place_id = $challengeData['place_id'];
    $backBtn = "<a href='../on-my-way/index.php?action=list-challenges'>Back To Challenges</a>";
    //Update existing Challenges
    if(isset($_POST['edit-challenge'])) {
        $cleanData = $c_manager->validateData($_POST);
        if($cleanData) {
            $c_manager->updateChallenge($cleanData);
            $formMsg = 'Record Updated!';
        } else {
            $formMsg = 'Form Validation Failed!';
        }
    }
    //4 Populate the existing form with data for that place
    require_once 'view/challenge-form.php';
} else {
    require_once 'view/placelistView.php';
}


