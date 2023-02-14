<?php

require_once './model/db.php';

class ChallengeManager extends Db {

    public function getPlaces() {
        $db = $this->connectDB();
        $places = $db->query("SELECT * FROM places");
        $places = $places->fetchAll();
        return $places;
    }

    public function getPlace($place_id) {
        $db = $this->connectDB();
        $place = $db->prepare("SELECT * FROM places WHERE id = ?");
        $place->execute([$place_id]);
        $place = $place->fetch();
        return $place;
    }
    
    public function getChallenges($place_id) {
        $db = $this->connectDB();
        $challenges = $db->prepare("SELECT * FROM challenges WHERE place_id = ?");
        $challenges->execute([$place_id]);
        $challenges = $challenges->fetchAll();
        return $challenges;
    }

    public function validatePlace($data) {
        foreach($data as $key => $value) {
            if(empty($value)) return false;
            if ($key == 'latitude' || $key == 'longitude') {
                if(!is_numeric($value)) return false;

                if($key == 'latitude' && ($value>90 || $value<-90)) return false;
                else if($key == 'longitude' && ($value>180 || $value<-180)) return false;

                preg_match('/-*[0-9]+[\.]*[0-9]*/', $value, $matches, PREG_OFFSET_CAPTURE);

                $value = trim(htmlspecialchars($matches[0][0]));
                $data[$key] = number_format(floatval($value), 15, '.');
            } else {
                if($key == 'add-place') continue;
                $data[$key] = trim(htmlspecialchars($value));
            }
        }
        return $data;    
    }

    public function addPlace($data) {
        $db = $this->connectDB();
        $newPlace = $db->prepare('
            INSERT INTO places (name, latitude, longitude)
            VALUES (:name, :latitude, :longitude)
        ');
        $newPlace->execute([
            'name' => $data['name'], 
            'latitude' => $data['latitude'], 
            'longitude' => $data['longitude']
        ]);
    }

    public function updateChallenge($data) {
        $db = $this->connectDB();
        $sql = "UPDATE challenges 
                SET name=:name, content=:content, conditions=:conditions, score=:score, place_id=:place_id, updated_date=:updated_date
                WHERE id=:id";
        $stmt= $db->prepare($sql);
        $stmt->execute([
            'id' => $data['edit'],
            'name' => $data['name'],
            'content' => $data['content'],
            'conditions' => $data['conditions'],
            'score' => $data['score'],
            'place_id' => $data['place_id'],
            'updated_date' => date("Y-m-d H:i:s")
        ]);
    }

    protected function delete($table_name, $id, $field_name = 'id') {
        $db = $this->connectDB();

        $delete = $db->prepare(
            "DELETE FROM " . $table_name . " WHERE " . $field_name . " = ?"
        );
        $delete->execute([$id]);
    }

    public function deletePlace($place_id)
    {
        // can't delete a place before all the challenges belong to this place has been deleted (by hand)
        $challenges = $this->getChallenges($place_id);
        if(empty($challenges)){
            $this->delete('places', $place_id);
            return 1;
        } else {
            return 'Failed! Delete the challenges on this place first to delete the place.';
        }
    }

    public function deleteChallenge($challenge_id)
    {
        $this->delete('challenges', $challenge_id);
        return 1;
    }

   
    public function validateData($data)
    {
      foreach($data as $key => $value) {
        if($key == 'add-challenge' || $key == 'edit-challenge') continue;
        if(empty($value)) return false;
        if($key == 'place_id' && $value == 0) return false;
        if($key == 'score' && !(is_numeric($value))) return false;
        $value = trim(htmlspecialchars($value));
      }
      return $data;
    }
    public function addChallenge($data)
    {
        $db = $this->connectDB();
        $newChallenge = $db->prepare('INSERT INTO challenges (name, content, conditions, place_id, score, created_date)
        VALUES (:name, :content, :conditions, :place_id, :score, :created_date)');
        $newChallenge->execute([
            'name' => $data['name'],
            'content' => $data['content'],
            'conditions' => $data['conditions'],
            'place_id' => $data['place_id'],
            'score' => $data['score'],
            'created_date' => date("Y-m-d H:i:s")
        ]);
    }

    public function retrieveChallenges()
    {
        $db = $this->connectDB();
        $challenges = $db->query('SELECT * FROM challenges');
        $challenges = $challenges->fetchAll();
        return $challenges;
    }
    public function getChallengeData($challengeId)
    {
        $db = $this->connectDB();
        $stmt = $db->prepare("SELECT * FROM challenges WHERE id=:id");
        $stmt->execute(['id' => $challengeId]); 
        $challengeData = $stmt->fetch();
        return $challengeData;
    }

    public function incrementUsersAccomplished($id) 
    {
        $db = $this->connectDB();
        $users_accomplished = 0;
        $stmt = $db->prepare("SELECT users_accomplished FROM challenges WHERE id=:id");
        $stmt->execute(['id' => $id]); 
        $data = $stmt->fetch();
        //If users already completed challenge, get current number and increment 
        if($data['users_accomplished'] && $data['users_accomplished'] > 0) {
            $users_accomplished = $data['users_accomplished'] + 1;
        } else {
        //Nobody has completed challenge yet, just set to 1...
            $users_accomplished = 1;
        }
        $sql = "UPDATE challenges
                SET users_accomplished=:users_accomplished
                WHERE id=:id";
        $stmt= $db->prepare($sql);
        $stmt->execute([
            'users_accomplished' => $users_accomplished,
            'id' => $id
        ]);
    }

    public function getNumUsersAccomplished($challenge_id) {
        $db = $this->connectDB();
        $accomplished = $db->prepare(
            "SELECT COUNT(user_id) AS count_users FROM `user_challenge_r` WHERE challenge_id =:id;"
        );
        $accomplished->execute(['id' => $challenge_id]); 
        $accomplished = $accomplished->fetch();
        
        return $accomplished['count_users'];
    }

    public function hasUserCompletedChall($user_id, $challenge_id) {
        $db = $this->connectDB();
        $accomplished = $db->prepare(
            "SELECT COUNT(id) as accomplished_count
            FROM `user_challenge_r` 
            WHERE challenge_id =:challenge_id 
            AND user_id=:user_id;"
        );
        $accomplished->execute([
            'challenge_id' => $challenge_id,
            'user_id' => $user_id
        ]); 
        $accomplished = $accomplished->fetch();
        return $accomplished['accomplished_count'];
    }

    public function getChallDataForAdmin() {
        $db = $this->connectDB();
        $challenges = $db->query(
            'SELECT 
                challenges.id, 
                challenges.name, 
                challenges.content, 
                challenges.conditions, 
                challenges.score, 
                challenges.created_date, 
                challenges.updated_date, 
                COUNT(user_challenge_r.id) as user_count,
                COUNT(challenge_comments.id) as comment_count
            FROM challenges 
            LEFT JOIN user_challenge_r 
                ON user_challenge_r.challenge_id = challenges.id 
            LEFT JOIN challenge_comments
            	ON challenges.id = challenge_comments.challenge_id
            GROUP BY challenges.id;'
        );
        $challenges = $challenges->fetchAll();
        return $challenges;
    }

    public function getPlacesForAdmin() {
        $db = $this->connectDB();
        $places = $db->query(
            'SELECT 
                places.id,
                places.name,
                CONCAT(places.latitude, ",", places.longitude) AS location,
                GROUP_CONCAT(challenges.name) AS challenges
            FROM places
            LEFT JOIN challenges 
                ON challenges.place_id = places.id
            GROUP BY places.id;'
        );
        $places = $places->fetchAll();
        return $places;
    }
}


