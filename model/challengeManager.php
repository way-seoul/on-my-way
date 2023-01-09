<?php

require_once './models/db.php';

class ChallengeManger extends Db {

    public function getPlaces() {
        //
    }

    protected function getPlace() {
        //
    }

    public function getChallenges() {
        //
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
        $this->delete('places', $place_id);
    }

    public function deleteChallenge($challenge_id)
    {
        $this->delete('challenges', $challenge_id);
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

