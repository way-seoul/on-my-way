<?php
include_once 'db.php';

class Admin extends Db {
    public function listUsers()
    {
        $db = Db::connectDB();

        $users = $db->query('SELECT * FROM users');
        $users = $users->fetchAll(PDO::FETCH_ASSOC);
        //FETCH_ASSOC means only fetch field name, instead both field name & index

        return $users;
    }

    public function listUser($id)
    {
        $db = Db::connectDB();

        $users = $db->prepare('SELECT * FROM users WHERE id = ?');
        $users->execute([$id]);

        $user = $users->fetch();

        return $user;
    }

    public function deleteUser($id)
    {
        $db = Db::connectDB();

        $users = $db->prepare('DELETE FROM users WHERE id = ?');
        $users->execute([$id]);
    }

    public function addUsers($entry){

        $db = Db::connectDB();

        //hash password
        $password=$entry["password"];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $entry['admin'] = isset($entry['admin']) ? $entry['admin']:'0';

        $newEntry = $db->prepare('
            INSERT INTO users (username, password, first_name, last_name, email, created_date, admin)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');
        $newEntry->execute([$entry['username'], $hashed_password, $entry['first_name'], $entry['last_name'], $entry['email'], date('Y-m-d H:i:s'), $entry['admin']]);
    }

    public function resetUserPassword($reset_password, $id){

        $db = DB::connectDB();
        $hashed_reset_password = password_hash($reset_password, PASSWORD_BCRYPT);
        $users = $db->prepare('UPDATE users SET password = ? WHERE id = ?');
        $users->execute([$hashed_reset_password, $id]);
    }

    function showEntry($id) 
    {
        $db = Db::connectDB();

        $users = $db->prepare('SELECT * FROM users WHERE id = ?');
        
        $users->execute([$id]);
        $user = $users->fetch();

        return $user;

    }

    function editEntry($id, $edited_username, $edited_email, $edited_firstname, $edited_lastname, $edited_admin) 
    {
        $db = Db::connectDB();

        $users = $db->prepare('UPDATE users SET username=?, email=?, first_name=?, last_name=?, admin=? WHERE id=?');
        
        $users->execute([$edited_username, $edited_email, $edited_firstname, $edited_lastname, $edited_admin, $id]);
    }

}