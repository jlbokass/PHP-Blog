<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 31/01/2019
 * Time: 01:15
 */

namespace App\Manager;


use App\Utilities\Auth;
use Core\Model;

/**
 * Class CommentManager
 * @package App\Manager
 */
class CommentManager extends Model
{
    /**
     * @var array
     */
    public $errors = [];
    /**
     * @var null
     */
    public $param;

    /**
     * CommentManager constructor.
     * @param array $data
     * @param null $params
     */
    public function __construct($data = [], $params = null)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };

        $this->param = $params;
    }

    /**
     * @param $id
     * @return array
     */

    /*
    public static function getAll($id)
    {
        $sql = 'SELECT comment.*, u.username as user_username
        FROM comment
        INNER JOIN user u on comment.FK_user_id = u.id
        INNER JOIN post p on comment.FK_post_id = p.id
        WHERE p.id = :postId AND comment.published = 1
        ORDER BY comment.id DESC ';

        $db = Model::getDB();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':postId', $id, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }
    */

    /**
     * @return array
     */
    public static function getAll()
    {
        $sql = 'SELECT comment.*, u.username as user_username, p.title as post_title
        FROM comment
        INNER JOIN user u on comment.FK_user_id = u.id
        INNER JOIN post p on comment.FK_post_id = p.id
        WHERE comment.published = 0
        ORDER BY comment.id DESC ';

        $db = Model::getDB();

        $stmt = $db->query($sql);

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * @param $postId
     */
    public static function getSingle($postId)
    {

    }


    /**
     * @return array
     */
    public static function getComment()
    {
        $sql = 'SELECT comment.*, u.username as user_username
        FROM comment
        INNER JOIN user u on comment.FK_user_id = u.id
        INNER JOIN post p on comment.FK_post_id = p.id
        WHERE comment.published = 0
        ORDER BY comment.id DESC ';

        $db = Model::getDB();

        $stmt = $db->query($sql);

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }


    /**
     * insert comment save comment in database, used by post controller in the single page
     * @return bool
     */
    public function save()
    {
        $this->validate();

        if (empty($this->errors)) {



            $sql = 'INSERT INTO comment(FK_user_id, FK_post_id, content, published, createdAt)
                VALUES (:FK_user_id, :FK_post_id, :content, 0, now())';


            $db = Model::getDB();

            $stmt = $db->prepare($sql);

            $stmt->bindValue(':FK_user_id', $this->FK_user_id, \PDO::PARAM_INT);
            $stmt->bindValue(':FK_post_id', $this->id, \PDO::PARAM_INT);
            $stmt->bindValue(':content', $this->content, \PDO::PARAM_STR);

            return $stmt->execute();
        }

        return false;
    }


    /**
     * show all post comment, used in post controller
     * @param $postId
     * @return array
     */
    public static function showAll($postId)
    {
        $sql = 'SELECT comment.*, u.username as user_username
        FROM comment
        INNER JOIN user u on comment.FK_user_id = u.id
        INNER JOIN post p on comment.FK_post_id = p.id
        WHERE p.id = :postId AND comment.published = 1
        ORDER BY comment.id DESC ';

        $db = Model::getDB();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':postId', $postId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }


    /**
     * show a single comment display in update method, in admin controller
     * @param $commentId
     * @return mixed
     */
    public static function showSingle($commentId)
    {
        $sql = 'SELECT comment.*, u.username as user_username
        FROM comment
        INNER JOIN user u on comment.FK_user_id = u.id
        INNER JOIN post p on comment.FK_post_id = p.id
        WHERE comment.id = :commentId AND comment.published = 0 ';

        $db = Model::getDB();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':commentId', $commentId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result;
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
     * @return mixed
     */
    public static function getPost()
    {
        if (isset($_SESSION['user_id'])) {

            return UsersManager::findById($_SESSION['user_id']);

        } else {

            return static::loginFromRememberCookie();
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

        $stmt->bindValue(':commentId', $commentId, \PDO::PARAM_INT);

        return $stmt->execute();
    }


    public static function delete($commentId)
    {

        $sql = 'DELETE FROM comment
          
                WHERE comment.id= :commentId';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':commentId', $commentId, \PDO::PARAM_INT);

        return $stmt->execute();
    }


    /**
     *
     */
    public static function publish($id)
    {
        $sql = 'SELECT comment.*, u.username as user_username
        FROM comment
        INNER JOIN user u on comment.FK_user_id = u.id
        INNER JOIN post p on comment.FK_post_id = p.id
        WHERE p.id = :postId AND comment.published = 1
        ORDER BY comment.id DESC ';

        $db = Model::getDB();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':postId', $id, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * @param $id
     * @return array
     */
    public static function validateComment($id)
    {
        $sql= 'UPDATE comment set published = 1
              WHERE id = :id';

        $db = Model::getDB();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':postId', $id, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }
}