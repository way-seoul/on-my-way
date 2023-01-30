<?php
class Db
{
    protected static function connectDB () {
        $db_username = isset($_SERVER['ONMYWAY_DB_USERNAME']) ? $_SERVER['ONMYWAY_DB_USERNAME']:'root';
        $db_password = $_SERVER['ONMYWAY_DB_PASSWORD'];
        return new PDO('mysql:host=localhost;dbname=on_my_way;charset=utf8', $db_username, $db_password);
    }
}  