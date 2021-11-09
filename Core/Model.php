<?php

namespace Core;

use PDO;
use App\Config_new;

/*Base model*/
abstract class Model
{

    //funkcja uzyskująca połączenie przez PDO z bazą danych
    protected static function getDB()
	{   
    static $db = null;
    if ($db === null) {
        
          $dsn = 'mysql:host=' . Config_new::DB_HOST . ';dbname=' . Config_new::DB_NAME . ';charset=utf8';
          $db = new PDO($dsn, Config_new::DB_USER, Config_new::DB_PASSWORD);
       
	   //wyrzuć wyjątek jeśli wystąpi błąd
	   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
	
    return $db;
	}   
}
