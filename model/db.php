<?php 

class DB {

    private static $db;

    public static function connectDB(){
        if(DB::$db == null){
            DB::$db = new PDO('mysql:host=localhost;dbname=on_my_way;charset=utf8', 'root', '');
        }
        return DB::$db;
    }
}