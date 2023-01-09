<?php

require_once './model/db.php';

class PlaceManager extends Db {

    public function retrievePlaces()
    {
        $db = $this->connectDB();
        $places = $db->query('SELECT * FROM places');
        $places = $places->fetchAll();
        return $places;
    }
}