<?php
include_once 'db.php';

class Users extends Db {

    public static function addUsers($entry){

        $db = DB::connectDB();

        //hash password
        $password=$entry["password"];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $newEntry = $db->prepare('
            INSERT INTO users (username, password, first_name, last_name, email, created_date, admin)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');
        $newEntry->execute([$entry['username'], $hashed_password, $entry['first_name'], $entry['last_name'], $entry['email'], date('Y-m-d H:i:s'), '0']);
    }

    public static function getUser($username){
        $db = DB::connectDB();

        $user = $db->prepare('SELECT username, password FROM users WHERE username = ?');
        $user->execute([$username]);
        return $user->fetch();
    }

    public function addChallengeAchievedPoints($id, $challengePoints) {
        $db = DB::connectDB();
        $newTotalPoints = 0;
        //First Get Current Points Total & Update it
        $user = $db->prepare('SELECT points_total FROM users WHERE id = ?');
        $user->execute([$id]);
        $currentTotalPoints = $user->fetch();
        if($currentTotalPoints && $currentTotalPoints > 0) {
            $newTotalPoints = $currentTotalPoints['points_total'] + $challengePoints;
        } else {
            $newTotalPoints = $challengePoints;
        }
        //Update User Record with new points total
        $sql = "UPDATE users
                SET points_total=:newTotalPoints
                WHERE id=:id";
        $stmt= $db->prepare($sql);
        $stmt->execute([
            'newTotalPoints' => $newTotalPoints,
            'id' => $id
        ]);
        return $newTotalPoints;
    }

    public function addRecordToUserChallTable($user_id, $challenge_id) {
        $db = DB::connectDB();
        $newRecord = $db->prepare(
            'INSERT INTO user_challenge_r
            (user_id, challenge_id)
            VALUES 
            (:user_id, :challenge_id)'
        );
        $newRecord->execute([
            'user_id' => $user_id,
            'challenge_id' => $challenge_id
        ]);
    }
}