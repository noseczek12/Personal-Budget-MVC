<?php

namespace App\Models;

use PDO;

/* Post model*/
class Post extends \Core\Model
{

    // funkcja zwracająca wszystkie posty z tablicy asocjacyjnej
    public static function getAll()
    {
        try {
            $db = static::getDB();

            $stmt = $db->query('SELECT id, title, content FROM posts
                                ORDER BY created_at');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
