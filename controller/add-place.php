<?php

require_once 'model/challengeManager.php';

$c_manager = new ChallengeManager();
$invalidInput = false;

if(isset($_POST['add-place']) && $_POST['add-place']) {
    $cleanData = $c_manager->validatePlace($_POST);
    if($cleanData) {
        $c_manager->addPlace($cleanData);
        header('Location: ' . $listChallenges_path);
    } else {
        // echo "validation failed.";
        $prefill = array(
            'name' => isset($_POST['name']) ? $_POST['name']:'',
            'latitude' => isset($_POST['latitude']) ? $_POST['latitude']:'',
            'longitude' => isset($_POST['longitude']) ? $_POST['longitude']:''
        );
        $invalidInput = true;
    }
}

require_once 'view/add-place-view.php';
