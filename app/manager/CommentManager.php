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

class CommentManager extends Model
{
    public $errors = [];
    public $param;

    public function __construct($data = [], $params)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };

        $this->param = $params;
    }

    public static function getAll($id)
    {
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



    public function save()
    {
        $this->validate();

        if (empty($this->errors)) {



            $sql = 'INSERT INTO comment(FK_user_id, FK_post_id, content, publish, createdAt)
                VALUES (:FK_user_id, :FK_post_id, :content, \'yes\', now())';


            $db = Model::getDB();

            $stmt = $db->prepare($sql);

            $stmt->bindValue(':FK_user_id', $this->param, \PDO::PARAM_INT);
            $stmt->bindValue(':FK_post_id', $this->post_id, \PDO::PARAM_INT);
            $stmt->bindValue(':content', $this->content, \PDO::PARAM_STR);

            return $stmt->execute();
        }

        return false;
    }

    public function validate()
    {
        if ($this->content == '') {
            $this->errors = 'vide';
        }
    }

    public static function getPost()
    {
        if (isset($_SESSION['user_id'])) {

            return UsersManager::findById($_SESSION['user_id']);

        } else {

            return static::loginFromRememberCookie();
        }
    }

    public static function update()
    {
        //
    }

    public static function delete()
    {
        //
    }
}