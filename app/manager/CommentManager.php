<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 31/01/2019
 * Time: 01:15
 */

namespace App\Manager;

use App\Model\Comment;
use Core\Model;
use PDO;

/**
 * Class CommentManager
 * @package App\Manager
 *
 * PHP version 7.1
 */
class CommentManager extends Model
{
    /**
     * Error message
     *
     * @var array
     */
    public $errors = [];


    /*
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
    */

    /**
     * get all comments from the blog
     *
     * @return array
     */
    public static function getAllComment()
    {
        $sql = 'SELECT comment.*, u.username as user_username, p.title as post_title
        FROM comment
        INNER JOIN user u on comment.FK_user_id = u.id
        INNER JOIN post p on comment.FK_post_id = p.id
        WHERE comment.published = 0
        ORDER BY comment.id DESC ';

        $db = Model::getDB();

        $stmt = $db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function save(Comment $comment)
    {
        $sql = 'INSERT INTO comment(FK_user_id, FK_post_id, content, createdAt)
                VALUES (:FK_user_id, :FK_post_id, :content, now())';


        $db = Model::getDB();

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':FK_user_id', $comment->FK_user_id, PDO::PARAM_INT);
        $stmt->bindValue(':FK_post_id', $comment->FK_post_id, PDO::PARAM_INT);
        $stmt->bindValue(':content', $comment->content, PDO::PARAM_STR);

        $stmt->execute();


        $comment->hydrate([
            'id' => $db->lastInsertId(),
            'published' => 0,
            'updatedAt' => 'null'
        ]);

        return $stmt;
    }


    /**
     * get all comments for an article, used in post controller
     *
     * @param $postId int
     * @return array
     */
    public static function getAllPostComment($postId)
    {
        $sql = 'SELECT comment.*, u.username as user_username
        FROM comment
        INNER JOIN user u on comment.FK_user_id = u.id
        INNER JOIN post p on comment.FK_post_id = p.id
        WHERE p.id = :postId AND comment.published = 1
        ORDER BY comment.id DESC ';

        $db = Model::getDB();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':postId', $postId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * show a single comment display in update method, in admin controller
     *
     * @param $commentId int
     * @return mixed
     */
    public static function getAComment($commentId)
    {
        $sql = 'SELECT comment.*, u.username as user_username
        FROM comment
        INNER JOIN user u on comment.FK_user_id = u.id
        INNER JOIN post p on comment.FK_post_id = p.id
        WHERE comment.id = :commentId AND comment.published = 0 ';

        $db = Model::getDB();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':commentId', $commentId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    /**
     *
     */
    public function validate()
    {
        if ($this->content == '') {
            $this->errors = 'vide';
        }
    }

    /**
     * used in admin controller to validate comments
     * @param $commentId
     * @return bool
     */
    public static function update($commentId)
    {
        $sql = 'UPDATE comment
                SET published = 1
                WHERE id = :commentId';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':commentId', $commentId, PDO::PARAM_INT);

        return $stmt->execute();
    }


    public static function delete($commentId)
    {
        $sql = 'DELETE FROM comment
                WHERE comment.id= :commentId';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':commentId', $commentId, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
