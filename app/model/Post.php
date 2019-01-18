<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 15/01/2019
 * Time: 02:03
 */

namespace App\Model;

use Core\Model;
use PDO;

/**
 * Class Post
 * @package App\Model
 */
class Post extends Model
{
    /**
     * @return array
     */
    public static function getAll()
    {
        $db = Model::getDB();
        $stmt = $db->query('SELECT id, title, content, createdAt FROM post ORDER BY id DESC ');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}