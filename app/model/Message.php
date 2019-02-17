<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 16/02/2019
 * Time: 20:20
 */

namespace App\Model;


class Message
{
    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $message;

    /**
     * @var array
     */
    public $errors = [];

    /**
     * HomeManager constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}