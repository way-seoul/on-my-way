<?php
include_once 'db.php';

class registerFunction{
    public function addUsers($entry){

        $db = DB::connectDB();

        $newEntry = $db->prepare('
            INSERT INTO users (username, password, first_name, last_name, email, created_date)
            VALUES (?, ?, ?, ?, ?, ?)
        ');
        $newEntry->execute([$entry['username'], $entry['password'], $entry['first_name'], $entry['last_name'], $entry['email'], date('Y-m-d H:i:s')]);
    }


}
