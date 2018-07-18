<?php
namespace App;

class App{

    const DB_NAME = 'blog';
    const DB_USER = 'root';
    const DB_PASS = 'root';
    const DB_HOST = '127.0.0.1';


    private static $database;

    public static function getDB()
    {
        if(self::$database === null){

            self::$database = new Database(self::DB_NAME, self::DB_USER, self::DB_PASS, self::DB_HOST);
        }


        return self::$database;
    }
    public static function notFound(){

        header("HTTP/1.0 404 Not Found");
        header('Location:index.php?p=404');
    }
}