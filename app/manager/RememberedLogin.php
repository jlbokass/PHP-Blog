<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 24/01/2019
 * Time: 14:17
 */

namespace App\Manager;


use App\Utilities\Token;
use Core\Model;

/**
 * Class RememberedLogin
 * @package App\Manager
 */
class RememberedLogin extends Model
{
    /**
     * @param $token
     * @return mixed
     */
    public static function findByToken($token)
    {
        $token = new Token($token);
        $token_hash = $token->getHash();

        $sql = 'SELECT * FROM remembered_login WHERE token_hash = :token_hash';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':token_hash', $token_hash, \PDO::PARAM_STR);

        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return User::findById($this->user_id);
    }

    /**
     * @return bool
     */
    public function hasExpired()
    {
        return strtotime($this->expires_at) < time();
    }

    /**
     *
     */
    public function delete()
    {
        $sql = 'DELETE FROM remembered_login
                WHERE token_hash = :token_hash';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':token_hash', $this->token_hash, \PDO::PARAM_STR);

        $stmt->execute();
    }
}