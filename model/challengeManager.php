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

    public function updateChallenge($data) {
        $db = $this->connectDB();
        $sql = "UPDATE challenges 
                SET name=:name, conditions=:conditions, score=:score, place_id=:place_id 
                WHERE id=:id";
        $stmt= $db->prepare($sql);
        $stmt->execute([
            'id' => $data['edit'],
            'name' => $data['name'],
            'conditions' => $data['conditions'],
            'score' => $data['score'],
            'place_id' => $data['place_id']
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
        // should delete all the challenges belong to this place
        $this->delete('places', $place_id);
    }

    public function deleteChallenge($challenge_id)
    {
        $this->delete('challenges', $challenge_id);
    }

   
    public function validateData($data)
    {
      foreach($data as $key => $value) {
        if($key == 'add-challenge' || $key == 'edit-challenge') continue;
        if(empty($value)) return false;
        if($key == 'score' && !(is_numeric($value))) return false;
        $value = trim(htmlspecialchars($value));
      }
      return $data;
    }
    public function addChallenge($data)
    {
        $db = $this->connectDB();
        $newChallenge = $db->prepare('INSERT INTO challenges (name, conditions, place_id, score, users_accomplished, created_date)
        VALUES (:name, :conditions, :place_id, :score, :users_accomplished, :created_date)');
        $newChallenge->execute([
            'name' => $data['name'],
            'conditions' => $data['conditions'],
            'place_id' => $data['place_id'],
            'score' => $data['score'],
            'users_accomplished' => 0,
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
}

