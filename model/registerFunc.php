<?php
include_once 'db.php';

class registerFunction extends Db{
    public function addUsers($entry){

        $db = Db::connectDB();

        //hash password
        $password=$entry["password"];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $newEntry = $db->prepare('
            INSERT INTO users (username, password, first_name, last_name, email, created_date, admin)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');
        $newEntry->execute([$entry['username'], $hashed_password, $entry['first_name'], $entry['last_name'], $entry['email'], date('Y-m-d H:i:s'), '0']);
    }

}
