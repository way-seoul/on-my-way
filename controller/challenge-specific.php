<?php

require_once 'model/challengeManager.php';
require_once 'model/commentManager.php';
require_once 'model/usersManager.php';
require_once 'controller/_paths.php';

$userManager = new Users();
$c_manager = new ChallengeManager();
$comment_manager = new CommentManager();

//USER ID NEED TO BE PULLED DYNAMICALLY FROM SESSION LATER..
$userID = 1;
$id = $_GET['id'] ?? '';

if($id) {
    $challenge = $c_manager->getChallengeData($id);
    $place = $c_manager->getPlace($challenge['place_id']);
}

if(isset($_POST['add_comment'])) {
    if(isset($_POST['comment_content'])) {
        $newComment = $comment_manager->addComment($id, $_POST['comment_content']);
    }
}

if(isset($_POST['delete'])) {
    $commentId = $_POST['comment_id'];
    //IF SET CALL DELETE FUNCTION.......
    if(isset($commentId)) {
        $comment_manager->deleteComment($commentId);
    }
}

//REQ SENT TO THIS ROUTE FROM CLIENT WHEN USER CLICKS "ON THE SPOT BTN" & VALIDATION PASSED....
if(isset($_POST['challengeAchieved'])) {
    //Update User Points Total, then increment users_accomplished for challenge, then add record to user_chal Table
    try {
        $userPointsTotal = $userManager->addChallengeAchievedPoints($_POST['userID'], $_POST['score']);
        $c_manager->incrementUsersAccomplished($_POST['challID']);
        $userManager->addRecordToUserChallTable($_POST['userID'], $_POST['challID']);
        die(
            json_encode(
                [
                    'msg' => 'Well Done You Completed The Challenge! Your new points total is ' . $userPointsTotal
                ]
            )
        );
    }
    catch(Exception $e) {
        die(
            json_encode(
                [
                'msg' => 'Sorry there was an issue updating the DB: ' .$e->getMessage()
                ]
            )
        );
    }
}

if($id) {
    $comments = $comment_manager->getAllCommentsForChallenge($id);
    require_once 'view/challenge-specific-view.php';
}
