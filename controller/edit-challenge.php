<?php

require_once 'model/challengeManager.php';
require_once 'model/placeManager.php';

$challenges = new ChallengeManager();
$places = new PlaceManager();
$data = $_POST ?? '';
$action = 'edit-challenge';
$btnText = 'Edit Challenge';

echo "HELLO WECLOME TO EDIT PAGE!";

//1 Pull List of Challenges
$existingChallenges = $challenges->retrieveChallenges();
//2 IF SUBMIT POST IS SET Click one to get edit Pop-Up
if($data) {
    //3 Get the place info for a given place ID
    $challengeData = $challenges->getChallengeData($data['edit-challenge-id']);
    //Pull list of existing places from DB for user to select from
    $existingPlaces = $places->retrievePlaces();
    echo "<pre>";
    print_r($challengeData);
    echo "</pre>";
    $name = $challengeData['name'];
    $conditions = $challengeData['conditions'];
    $score = $challengeData['score'];
    $edit_place_id = $challengeData['place_id'];
    //4 Populate the existing form with data for that place
    require_once 'view/challenge-form.php';
    //5 If form submitted.... update existing entry (after data validation)
} else {
    require_once 'view/edit-challenge.php';
}

