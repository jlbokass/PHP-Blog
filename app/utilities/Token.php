<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 23/01/2019
 * Time: 00:44
 */

namespace App\Utilities;

use Config\Config;

/**
 * Class Token
 *
 * @package App\Utilities
 *
 * PHP version 7.1
 */
class Token
{
    /**
     * The token value
     * @var array
     */
    protected $token;


    /**
     * Token constructor.
     *
     * @param string value (optional) A $token_value
     *
     * @throws \Exception
     *
     * @return string A 32-character token
     */
    public function __construct($token_value = null)
    {
        if ($token_value) {

            $this->token = $token_value;

        } else {

            $this->token = bin2hex(random_bytes(16)); // 16 bytes = 128 bits = 32 hex characters, convert to ASCII string

        }

    }

    /**
     * @return array|string
     */
    public function getValue()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return hash_hmac('sha256', $this->token, Config::SECRET_KEY);
    }
}
