<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 31/01/2019
 * Time: 01:15
 */

namespace App\Manager;


use Core\Model;

class CommentManager extends Model
{
    public static function getAll($id)
    {
        /*
        $sql = 'SELECT c.FK_user_id,
                FK_post_id,
                c.content AS comment_content,
                DATE_FORMAT(c.createdAt, \'%d/%m/%Y à %Hh%imin\') AS created_at
                FROM comment c
                INNER JOIN user u on c.FK_user_id = u.id
                INNER JOIN post p on c.FK_post_id = p.id
                WHERE p.id =:postId
                ORDER BY c.id DESC ';
        */

        $sql = 'SELECT comment.*, u.username as user_username
        FROM comment
        INNER JOIN user u on comment.FK_user_id = u.id
        INNER JOIN post p on comment.FK_post_id = p.id
        WHERE p.id = :postId
        ORDER BY comment.id DESC ';


        $db = Model::getDB();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':postId', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }
}