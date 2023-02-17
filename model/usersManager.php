<?php
include_once 'db.php';

class Users extends Db {

    public static function addUsers($entry){

        $db = DB::connectDB();

        //hash password
        $password=$entry["password"];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $newEntry = $db->prepare('
            INSERT INTO users (username, password, first_name, last_name, email, created_date, admin, is_deleted)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ');
        $newEntry->execute([$entry['username'], $hashed_password, $entry['first_name'], $entry['last_name'], $entry['email'], date('Y-m-d H:i:s'), '0', '0']);
    }

    public static function getUser($username){
        $db = DB::connectDB();

        $user = $db->prepare('SELECT username, password, id, admin, email FROM users WHERE username = ? AND is_deleted = 0');
        $user->execute([$username]);
        
        return $user->fetch();
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

    public function getLeadingUsers($how_many) {
        // for the leader board on the HOMEPAGE
        $db = DB::connectDB();
        $query =             
            'SELECT 
                users.username,
                -- users.points_total,
                SUM(challenges.score) as points_total,
                GROUP_CONCAT(challenges.id) AS challenge_ids
            FROM users
            LEFT JOIN user_challenge_r
                ON users.id = user_challenge_r.user_id
            LEFT JOIN challenges
                ON challenges.id = user_challenge_r.challenge_id
            GROUP BY users.id
            ORDER BY points_total DESC LIMIT ' . $how_many;
        $leaders = $db->query($query);

        $leaders = $leaders->fetchAll();
        return $leaders;
    }

    public static function getUserTotalPoints($user_id) {
        $db = DB::connectDB();

        $points = $db->prepare(
        'SELECT SUM(challenges.score) as points_total
        FROM users
        LEFT JOIN user_challenge_r
        ON users.id = user_challenge_r.user_id
        LEFT JOIN challenges
        ON challenges.id = user_challenge_r.challenge_id
        WHERE users.id= ?
        GROUP BY users.id');

        $points->execute([$user_id]);
        $total_points = $points->fetch();

        return $total_points;
    }

}