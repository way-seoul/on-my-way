<?php
include_once '_paths.php';
include_once './model/challengeManager.php';
include_once './model/placeManager.php';
include_once './model/commentManager.php';
require_once 'model/usersManager.php';

class ChallengeContr {
    public static function createChallenge(){
        $challenges = new ChallengeManager();
        $places = new PlaceManager();
        $action = 'create-challenge';
        // $btnText = 'Add A New Challenge';
        $btnText = 'Save';
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
        require_once 'view/listChallengesView.php';
    }

    public static function editChallenges(){
        if(!isset($_SESSION['logged_in'])) header('location: index.php?action=');

        $c_manager = new ChallengeManager();
        $p_manager = new PlaceManager();

        // if(isset($_POST['edit'])) {
        // $challengeId = $_POST['edit'];
        $challengeId = $_GET['id'];

        //POPULATE EDIT FORM WITH EXISTING DATA FOR THAT CHALLENGE
        $challengeData = $c_manager->getChallengeData($challengeId);
        $existingPlaces = $p_manager->retrievePlaces();
        $action = 'edit-challenge&id='. $challengeId;
        $btnName = 'edit-challenge';
        // $btnText = 'Edit Challenge';
        $btnText = 'Done';
        $name = $challengeData['name'];
        $content = $challengeData['content'];
        $conditions = $challengeData['conditions'];
        $score = $challengeData['score'];
        $edit_place_id = $challengeData['place_id'];
        $backBtn = "<a href='" . ADMIN_PATH . "'>← Go Back</a>";
    
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
    }

    public static function showChallengeInfo(){
        $userManager = new Users();
        $c_manager = new ChallengeManager();
        $comment_manager = new CommentManager();

        //USER ID NEED TO BE PULLED DYNAMICALLY FROM SESSION LATER..
        $userID = 1;
        $id = $_GET['id'] ?? '';

        //IF GET REQ WAS MADE FOR A SPECIFIC CHALL, THEN POPULATE PAGE WITH RELEVANT CHALLENGE INFO..
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
    }
}