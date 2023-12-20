<?php
namespace app\models;
require_once 'db_config.php';
use PDO;

class Model
{

    protected static $db;



    public static function database()
    {
        if (is_null(static::$db)) {
            static::$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        }
        return static::$db;
    }
}