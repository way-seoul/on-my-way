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
}