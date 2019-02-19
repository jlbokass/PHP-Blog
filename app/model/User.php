<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 11/02/2019
 * Time: 05:36
 */

namespace App\Model;

/**
 * Class User
 *
 * @package App\Model
 */
class User
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $password_hash;
    /**
     * @var bool
     */
    public $role;
    /**
     * @var string
     */
    public $password_hash_reset;
    /**
     * @var string
     */
    public $password_hash_reset_expires_at;
    /**
     * @var string
     */
    public $activation_hash;
    /**
     * @var bool
     */
    public $is_active;
    /**
     * @var string
     */
    public $avatar;
    /**
     * @var string
     */
    public $registeredAt;

    /**
     * User constructor.
     *
     * @param $data array
     */
    public function __construct($data)
    {
        $this->hydrate($data);
    }

    /**
     * give attributes values to work properly
     *
     * @param array $data
     */
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->password_hash;
    }

    /**
     * @param string $password_hash
     */
    public function setPasswordHash(string $password_hash): void
    {
        $this->password_hash = $password_hash;
    }

    /**
     * @return bool
     */
    public function isRole(): bool
    {
        return $this->role;
    }

    /**
     * @param bool $role
     */
    public function setRole(bool $role): void
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getPasswordHashReset(): string
    {
        return $this->password_hash_reset;
    }

    /**
     * @param string $password_hash_reset
     */
    public function setPasswordHashReset(string $password_hash_reset): void
    {
        $this->password_hash_reset = $password_hash_reset;
    }

    /**
     * @return string
     */
    public function getPasswordHashResetExpiresAt(): string
    {
        return $this->password_hash_reset_expires_at;
    }

    /**
     * @param string $password_hash_reset_expires_at
     */
    public function setPasswordHashResetExpiresAt(string $password_hash_reset_expires_at): void
    {
        $this->password_hash_reset_expires_at = $password_hash_reset_expires_at;
    }

    /**
     * @return string
     */
    public function getActivationHash(): string
    {
        return $this->activation_hash;
    }

    /**
     * @param string $activation_hash
     */
    public function setActivationHash(string $activation_hash): void
    {
        $this->activation_hash = $activation_hash;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * @param bool $is_active
     */
    public function setIsActive(bool $is_active): void
    {
        $this->is_active = $is_active;
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @return string
     */
    public function getRegisteredAt(): string
    {
        return $this->registeredAt;
    }

    /**
     * @param string $registeredAt
     */
    public function setRegisteredAt(string $registeredAt): void
    {
        $this->registeredAt = $registeredAt;
    }


}
