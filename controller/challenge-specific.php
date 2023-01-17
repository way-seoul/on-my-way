<?php

require_once 'model/challengeManager.php';
require_once 'model/commentManager.php';
$c_manager = new ChallengeManager();
$comment_manager = new CommentManager();
$id = $_GET['id'];
$challenge = $c_manager->getChallengeData($id);
$place = $c_manager->getPlace($challenge['place_id']);
//Next Steps:
$comments = $comment_manager->getAllCommentsForChallenge($id);
//Pull all comments for this challenge from DB & store in comments variable
//Include a challenge-comments file inside challenge-specific-view.. loop through comments there..

require_once 'view/challenge-specific-view.php';
