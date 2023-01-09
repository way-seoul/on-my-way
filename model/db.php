<?php
class Db
{
    protected static function connectDB () {
        return new PDO('mysql:host=localhost;dbname=on_my_way;charset=utf8', 'root', '');
    }
}