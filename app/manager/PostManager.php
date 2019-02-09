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

    public $errors = [];

    public function __construct($data = null)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    /**
     * @param null $postId
     * @return array|mixed
     */
    public static function getAll($postId = null)
    {
        if($postId) {
                $sql = 'SELECT post.id,
                post.title,
                post.headline,
                post.content,
                post.createdAt,
                u.username AS user_username
                FROM post
                INNER JOIN user u on post.FK_user_id = u.id
                WHERE post.id = :postId';

            $db = Model::getDB();

            $stmt = $db->prepare($sql);
            $stmt->bindValue(':postId', $postId, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch();

            return $result;
        }

        /*
        $sql2 = 'SELECT post.id, FK_user_id, title,
                left(content,100) AS sentence, content,
                DATE_FORMAT(createdAt, \'%d/%m/%Y à %Hh%imin\')
                AS created_at
                FROM post
                INNER JOIN user u on post.FK_user_id = u.id
                ORDER BY post.id DESC ';
        */

        $sql = 'SELECT post.id,
                post.title,
                post.headline,
                post.content,
                post.createdAt,
                u.username AS user_username
                FROM post
                INNER JOIN user u on post.FK_user_id = u.id
                ORDER BY post.id DESC ';

        $db = Model::getDB();

        $stmt = $db->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * @param $postId
     * @return mixed
     */
    public static function getSingle($postId)
    {

        $sql = 'SELECT id, title,
                headline,
                content,
                createdAt
                FROM post
                WHERE post.id = :postId';

        $db = Model::getDB();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':postId', $postId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch();

        return $result;
    }

    public static function getAllFromUser($userId)
    {

            $sql = 'SELECT * FROM post
                    WHERE post.FK_user_id = :postId';

            $db = Model::getDB();

            $stmt = $db->prepare($sql);
            $stmt->bindValue(':postId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetchAll();

            return $result;

    }


    public function save()
    {
        $this->validate();

        if (empty($this->errors)) {



            $sql = 'INSERT INTO post(FK_user_id, title, headline, content, createdAt)
                VALUES (:FK_user_id, :title, :headline, :content, now())';


            $db = Model::getDB();

            $stmt = $db->prepare($sql);

            $stmt->bindValue(':FK_user_id', $this->FK_user_id, \PDO::PARAM_INT);
            $stmt->bindValue(':title', $this->title, \PDO::PARAM_STR);
            $stmt->bindValue(':headline', $this->headline, \PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, \PDO::PARAM_STR);

            return $stmt->execute();
        }

        return false;
    }


    public function validate()
    {
        // title
        if ($this->title == '') {
            $this->errors[] = 'title is required';
        }

        // headline
        if ($this->headline == '') {
            $this->errors[] = 'headline is required';
        }

        // content
        if ($this->content == '') {
            $this->errors[] = 'content is required';
        }

    }

    public function updateAPost($data)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->headline = $data['headline'];
        $this->content = $data['content'];

        $this->validate();

        if (empty($this->errors)) {

            $sql = 'UPDATE post
                    SET title = :title,
                        headline = :headline,
                        content = :content,
                        createdAt = now()
                        where id = :id';


            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':headline', $this->headline, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

            return $stmt->execute();
        }

        return false;
    }


    public function delete()
    {

        $sql = 'DELETE FROM post
          
                WHERE post.id= :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }


}