<?php

namespace Core;

use PDO;
use App\Config;

/*Base model*/
abstract class Model
{

    //funkcja uzyskująca połączenie przez PDO z bazą danych
    protected static function getDB()
	{   
    static $db = null;
    if ($db === null) {
        
        try {
          $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
           $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    return $db;
	}   
}
