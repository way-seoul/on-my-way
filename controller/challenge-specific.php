<?php

require_once 'model/challengeManager.php';
require_once 'model/commentManager.php';
require_once 'controller/_paths.php';
$c_manager = new ChallengeManager();
$comment_manager = new CommentManager();
$id = $_GET['id'];
$challenge = $c_manager->getChallengeData($id);
$place = $c_manager->getPlace($challenge['place_id']);
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
$comments = $comment_manager->getAllCommentsForChallenge($id);

require_once 'view/challenge-specific-view.php';
