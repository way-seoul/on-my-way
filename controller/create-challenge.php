<?php
// require_once 'model/challengeManager.php';

// $challenges = new ChallengeManger();

// BEFORE THAT FORM IS LOADED.. Need to pull out list of place names to populate form
require_once 'view/create-challenge-form.php';
require_once 'model/challengeManager.php';

//IF POST ARR IS SET - THEN FORM HAS BEEN SUBMITTED
$data = $_POST ?? null;
if($data) {
    //Validate the data is ok
    print_r($data);
    //IF NO RETURN MSG TO USER
    //IF YES ADD DATA TO DB
}