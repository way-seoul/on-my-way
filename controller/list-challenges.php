<?php

require_once 'model/challengeManager.php';

$c_manager = new ChallengeManager();
$places = $c_manager->getPlaces();


require_once 'view/placelistView.php';
