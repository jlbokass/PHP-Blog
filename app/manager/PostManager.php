<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 15/01/2019
 * Time: 02:03
 */

namespace App\Manager;

use Core\Model;
use PDO;

/**
 * Class PostManager
 * @package App\Model
 */
class PostManager extends Model
{
    /**
     * @return array
     */
    public static function getAll()
    {
        $sql = 'SELECT post.id, FK_user_id, title,
                left(content,100) AS sentence, content,
                DATE_FORMAT(createdAt, \'%d/%m/%Y à %Hh%imin\')
                AS created_at
                FROM post
                INNER JOIN user u on post.FK_user_id = u.id
                ORDER BY post.id DESC ';

        $db = Model::getDB();

        $stmt = $db->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public static function getSingle($postId)
    {
        $sql = 'SELECT title, content,
                DATE_FORMAT(createdAt, \'%d/%m/%Y à %Hh%imin\') AS created_at 
                FROM post
                WHERE post.id = :postId';

        $db = Model::getDB();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':postId', $postId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch();

        return $result;
    }


}