<?php

class ChallengeManger {

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
        // $db = $this->connectDB();

        // $delete = $db->prepare(
        //     "DELETE FROM " . $table_name . " WHERE " . $field_name . " = ?"
        // );
        // $delete->execute([$id]);
    }

    public function deletePlace($place_id)
    {
        $this->delete('places', $place_id);
    }

    public function deleteChallenge($challenge_id)
    {
        $this->delete('challenges', $challenge_id);
    }

}

