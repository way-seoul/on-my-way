<?php

require_once './model/db.php';

class ChallengeManager extends Db {
   
    public function validateData($data)
    {
      foreach($data as $key => $value) {
        if($key == 'submit') continue;
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
}

