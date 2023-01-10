<?php
include_once 'db.php';

class adminFunction{
    public function listUsers()
    {
        $db = DB::connectDB();

        $users = $db->query('SELECT * FROM users');
        $users = $users->fetchAll(PDO::FETCH_ASSOC);
        //FETCH_ASSOC means only fetch field name, instead both field name & index

        return $users;
    }

    public function listUser($id)
    {
        $db = DB::connectDB();

        $users = $db->prepare('SELECT * FROM users WHERE id = ?');
        $users->execute([$id]);

        $user = $users->fetch();

        return $user;
    }

    public function deleteUser($id)
    {
        $db = DB::connectDB();

        $users = $db->prepare('DELETE FROM users WHERE id = ?');
        $users->execute([$id]);
    }

    public function addUsers($entry){

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

}