<?php
include_once 'db.php';

class adminEditFunction {
    function showEntry($id) 
    {
        $db = DB::connectDB();

        $users = $db->prepare('SELECT * FROM users WHERE id = ?');
        
        $users->execute([$id]);
        $user = $users->fetch();

        return $user;

    }

    function editEntry($id, $edited_username, $edited_password, $edited_email, $edited_firstname, $edited_lastname, $edited_admin) 
    {
        $db = DB::connectDB();

        $users = $db->prepare('UPDATE users SET username=?, password=?, email=?, first_name=?, last_name=?, admin=? WHERE id=?');

        // $places = $db->prepare('UPDATE place SET name = '.$edited_name.', country = '.$edited_country.', city='.$edited_city.', price='.$edited_price.', link='.$edited_link.' WHERE id= ?');
        
        $users->execute([$edited_username, $edited_password,$edited_email,$edited_firstname, $edited_lastname, $edited_admin, $id]);
    }
}