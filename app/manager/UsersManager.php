<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 17/01/2019
 * Time: 06:04
 */

namespace App\Manager;

use PDO;
use App\Utilities\Mail;
use App\Utilities\Token;
use Core\View;
use Core\Model;

/**
 * Class UsersManager
 * @package App\Model
 */
class UsersManager extends Model
{
    /**
     * @var array
     */
    public $errors = [];

    /**
     * UsersManager constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    /**
     * @return bool
     */
    public function save()
    {
        $this->validate();

        if (empty($this->errors)) {

            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

            $token = new Token();
            $hashed_token = $token->getHash();
            $this->activation_token = $token->getValue();

            $sql = 'INSERT INTO user (username, email, password_hash, role
            ,activation_hash, registeredAt)
            VALUES (:username, :email, :password_hash,\'user\', :activation_hash, now())';

            $db = Model::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
            $stmt->bindValue(':activation_hash', $hashed_token, PDO::PARAM_STR);

            return $stmt->execute();
        }

        return false;
    }

    /**
     *
     */
    public function validate()
    {
        // Username
        if ($this->username == '') {
            $this->errors[] = 'username is required';
        }

        // email address
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[] = 'Invalid email';
        }


        if (static::emailExists($this->email, $this->id ?? null)) {
            $this->errors[] = 'email already taken';
        }


        // Password
        if (isset($this->password)) {

            if ($this->password != $this->password_confirmation) {
              $this->errors[] = 'Password must match confirmation';
            }

            if (strlen($this->password) < 6) {
                $this->errors[] = 'Please enter at least 6 characters for the password';
            }

            if (preg_match('/.*[a-z]+.*/i', $this->password) == 0) {
                $this->errors[] = 'Password needs at least one letter';
            }

            if (preg_match('/.*\d+.*/i', $this->password) == 0) {
                $this->errors[] = 'Password needs at least one number';
            }

        }

        // Password
        //if ($this->password != $this->password_confirmation) {
            //$this->errors[] = 'Password must match confirmation';
        //}

        //if (strlen($this->password) < 6) {
          //$this->errors[] = 'Please enter at least 6 characters for the password';
        //}

        //if (preg_match('/.*[a-z]+.*/i', $this->password) == 0) {
           // $this->errors[] = 'Password needs at least one letter';
        //}

        //if (preg_match('/.*\d+.*/i', $this->password) == 0) {
           // $this->errors[] = 'Password needs at least one number';
       // }

    }

    /**
     * @param $email
     * @param null $ignore_id
     * @return mixed
     */
    public static function emailExists($email, $ignore_id = null)
    {
        $user = static::findByEmail($email);

        if ($user) {

            if ($user->id !=$ignore_id) {

                return true;
            }
        }

        return false;
    }

    /**
     * @param $username
     * @return mixed
     *
    public static function usernameExists($username, $ignore_id = null)
    {
        $user = static::findByUsername($username);

        if ($user->username !=$ignore_id) {

            return true;
        }

        return false;
    }

    */


    /**
     * @param $email
     * @return mixed
     */
    public static function findByEmail($email)
    {
        $sql = 'SELECT * FROM user WHERE email = :email';

        $db = Model::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * @param $email
     * @param $password
     * @return bool|mixed
     */
    public static function authenticate($email, $password)
    {
        $user = static::findByEmail($email);

        if ($user && $user->is_active) {

            if (password_verify($password, $user->password_hash)) {
                return $user;
            }
        }

        return false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function findById($id)
    {
        $sql = 'SELECT * FROM user WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * @param $username
     * @return mixed
     *
    public static function findByUsername($username)
    {
        $sql = 'SELECT * FROM user WHERE username = :username';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }
    */

    /**
     * @return bool
     */
    public function rememberLogin()
    {
        $token = new Token();
        $hashed_token = $token->getHash();
        $this->remember_token = $token->getValue();

        $this->expery_timestamp = time() + 60 * 60 * 24 * 30; // 30 days

        $sql = 'INSERT INTO remembered_login (token_hash, user_id, expires_at)
        VALUE (:token_hash, :user_id, :expires_at)';

        $db = Model::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':token_hash', $hashed_token, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':expires_at', date('Y-m-d H:i:s', $this->expery_timestamp),
            PDO::PARAM_STR);

        return $stmt->execute();
    }


    /**
     * @param $email
     */
    public static function sendPasswordReset($email)
    {
        $user = static::findByEmail($email);

        if($user) {

            if ($user->startPasswordReset()) {

                $user->sendPasswordResetEmail();
            }
        }
    }

    /**
     * @return bool
     */
    protected function startPasswordReset()
    {
        $token = new Token();
        $hashed_token = $token->getHash();
        $this->password_reset_token = $token->getValue();

        $expiry_timestamp = time() + 60 * 60 * 2; // 2 hours from now

        $sql ='UPDATE user
        SET password_reset_hash = :token_hash,
        password_reset_expires_at = :expires_at
        WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':token_hash', $hashed_token, PDO::PARAM_STR);
        $stmt->bindValue(':expires_at', date('Y-m-d H:i:s', $expiry_timestamp),
            PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();

    }

    /**
     *
     */
    protected function sendPasswordResetEmail()
    {
        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/password/reset/' . $this->password_reset_token;

        $text = View::getTemplate('Password/reset_email.txt', ['url' => $url]);
        $html = View::getTemplate('Password/reset_email.html', ['url' => $url]);


        Mail::send($this->email, 'Password reset', $text, $html);
    }

    /**
     * @param $token
     * @return mixed
     */
    public static function findByPasswordReset($token)
    {
        $token = new Token($token);
        $hashed_token = $token->getHash();

        $sql ='SELECT * FROM user
              where password_reset_hash = :token_hash';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':token_hash', $hashed_token, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        $user = $stmt->fetch();

        if ($user) {

            if (strtotime($user->password_reset_expires_at) > time()) {

                return $user;
            }
        }
    }

    /**
     * @param $password
     * @return bool
     */
    public function resetPassword($password)
    {
        $this->password = $password;

        $this->validate();

        if (empty($this->errors)) {

            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

            $sql = 'UPDATE user
            SET password_hash = :password_hash,
            password_reset_hash = NULL,
            password_reset_expires_at = NULL
            WHERE id = :id';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindValue(':password_hash', $password_hash,PDO::PARAM_STR);

            return $stmt->execute();
        }

        return false;
    }

    public function sendActivationEmail()
    {
        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/signup/activate/' . $this->activation_token;

        $text = View::getTemplate('Signup/activation_email.txt', ['url' => $url]);
        $html = View::getTemplate('Signup/activation_email.html', ['url' => $url]);


        Mail::send($this->email, 'Account activation', $text, $html);
    }

    public static function activate($value)
    {
        $token = new Token($value);
        $hashed_token = $token->getHash();

        $sql = 'UPDATE user
                SET is_active =1,
                activation_hash = null
                WHERE activation_hash = :hashed_token';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':hashed_token', $hashed_token, PDO::PARAM_STR);

        $stmt->execute();
    }

    public function updateProfile($data)
    {
        $this->username = $data['username'];
        $this->email = $data['email'];

        // Only validate and update the password if a value provided
        if ($data['password'] != '') {
            $this->password = $data['password'];
        }

        $this->validate();

        if (empty($this->errors)) {

            $sql = 'UPDATE user
                    SET username = :username,
                        email = :email';

            // Add password if it's set
            if (isset($this->password)) {
                $sql .= ', password_hash = :password_hash';
            }

            $sql .= "\nWHERE id = :id";

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

            // Add password if it's set
            if (isset($this->password)) {
                $password_hash = password_hash($this->password, PASSWORD_DEFAULT);
                $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
            }

            return $stmt->execute();
        }

        return false;
    }
}