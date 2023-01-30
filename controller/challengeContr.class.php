<?php
include_once '_paths.php';
include_once './model/challengeManager.php';
include_once './model/placeManager.php';
include_once './model/commentManager.php';

class ChallengeContr {
    public static function createChallenge(){
        $challenges = new ChallengeManager();
        $places = new PlaceManager();
        $action = 'create-challenge';
        $btnText = 'Add A New Challenge';
        $btnName = 'add-challenge';

        //IF POST ARR IS SET - THEN FORM HAS BEEN SUBMITTED
        $data = $_POST ?? null;
        if(isset($_POST['add-challenge']) && $data) {
            $cleanData = $challenges->validateData($data);
            if($cleanData) {
                $challenges->addChallenge($cleanData);
                $formMsg = 'New Challenge Added';
            } else {
                $formMsg = 'Form Validation Failed!';
            }
        }

        //Pull list of existing places from DB for user to select from
        $existingPlaces = $places->retrievePlaces();

        require_once 'view/challenge-form.php';
    }

    public static function listChallenges(){
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
            $content = $challengeData['content'];
            $conditions = $challengeData['conditions'];
            $score = $challengeData['score'];
            $edit_place_id = $challengeData['place_id'];
            $backBtn = "<a href='" . LIST_CHALLENGES_PATH . "'>Back To Challenges</a>";

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
    }

    public static function showChallengeInfo(){
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
    }
}