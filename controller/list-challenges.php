<?php

require_once 'model/challengeManager.php';
require_once 'model/placeManager.php';

$c_manager = new ChallengeManager();
$p_manager = new PlaceManager();
$places = $c_manager->getPlaces();

if(isset($_POST['delete']) && $_POST['delete']!= '') {
    $c_manager->deleteChallenge($_POST['delete']);
}else if(isset($_POST['delete-Place']) && $_POST['delete-Place']!='') {
    $delete_msg = $c_manager->deletePlace($_POST['delete-Place']);
    if($delete_msg == 1) {
        header('Location:' . $listChallenges_path);
    }
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
    $backBtn = "<a href='" . $listChallenges_path . "'>Back To Challenges</a>";
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
    //THIS IT THE DEFAULT LIST VIEW WHICH SHOWS UNLESS THE EDIT BUTTON IS CLICKED!
    require_once 'view/placelistView.php';
}


