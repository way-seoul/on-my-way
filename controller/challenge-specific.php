<?php

require_once 'model/challengeManager.php';

$c_manager = new ChallengeManager();
$id = $_GET['id'];
$challenge = $c_manager->getChallenge($id);
$place = $c_manager->getPlace($challenge['place_id']);

require_once 'view/challenge-specific-view.php';
