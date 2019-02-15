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
     * @var array
     */
    public $errors = [];

    /**
     * PostManager constructor.
     *
     * @param null $data
     */
    public function __construct($data = null)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }


    /**
     * if true, return all articles
     *
     * @return array
     */
    public static function getAll()
    {
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

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * @param $limit
     * @param $offset
     *
     * @return array
     */
    public static function getPage($limit, $offset)
    {
        $sql = 'SELECT post.id,
                post.title,
                post.headline,
                post.content,
                post.createdAt,
                u.username AS user_username
                FROM post
                INNER JOIN user u on post.FK_user_id = u.id
                ORDER BY post.id DESC 
                LIMIT :limit
                OFFSET :offset';

        $db = Model::getDB();

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    /**
     * if true, show single post filtered by postId
     *
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

        return $stmt->fetch();
    }


    /**
     * insert valid post data to database
     *
     * @return bool
     */
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


    /**
     * check if the entered data is valid
     *
     * @return void
     */
    public function validate()
    {
        if (empty($this->title)) {
            $this->errors[] = 'title is required';
        }

        if ($this->headline == '') {
            $this->errors[] = 'headline is required';
        }

        if ($this->content == '') {
            $this->errors[] = 'content is required';
        }
    }

    /**
     * @param $data
     *
     * @return bool
     */
    public function update($data)
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


    /**
     * delete a comment, return false if not
     *
     * @return bool
     */
    public function delete()
    {
        $sql = 'DELETE FROM post
          
                WHERE post.id= :id;
                (select * from comment)';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
