<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 17/01/2019
 * Time: 06:04
 */

namespace App\Model;


use Core\Model;

class User extends Model
{
    private $email;
    private $password_hash;
    private $password_confirmation;
    public $errors = [];

    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function save()
    {
        $this->validate();

        if (empty($this->errors)) {
            $this->password_hash = password_hash($this->password_hash, PASSWORD_DEFAULT);
            $sql = 'INSERT INTO user (email, password_hash, role, registeredAt)
               VALUES(:email, :password_hash, \'user\', now())';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':email', $this->email, \PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', $this->password_hash, \PDO::PARAM_STR);

            $stmt->execute();
        }

        return false;
    }

    public function validate()
    {
        // email address
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[] = 'Invalide email';
        }
        if ($this->emailExists($this->email)) {
            $this->errors[] = 'Email already taken';
        }

        //password
        if ($this->password_hash != $this->password_confirmation) {
            $this->errors[] = 'Password must match confirmation';
        }

        if (strlen($this->password_hash) < 6) {
            $this->errors[] = 'Please enter at least 6 characters for password';
        }

        if (preg_match('/.*[a-z]+.*/i', $this->password_hash) == 0) {
            $this->errors[] = 'Password needs at least one letter';
        }

        if (preg_match('/.*\d+.*/i', $this->password_hash) == 0) {
            $this->errors[] = 'Password needs at least one number';
        }
    }

    protected function emailExists($email)
    {
        $sql = 'SELECT * FROM user WHERE email = :email';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email',$email, \PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch() !== false;
    }
}