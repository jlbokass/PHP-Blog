<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 07/02/2019
 * Time: 17:53
 */

namespace App\Manager;


/**
 * Class HomeManager
 * @package App\Manager
 *
 * PHP version 7.1
 */
class HomeManager
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

    /**
     * @return bool
     */
    public function sendEmailToAdmin()
    {
        $this->validate();

        if (empty($this->errors)) {

            return true;
        }

        return false;
    }

    /**
     * Validate current property values, adding validation error messages to the errors array property
     *
     * @return void
     */
    public function validate()
    {

        if ($this->firstName == '') {
            $this->errors[] = 'firstName is required';
        }


        if ($this->lastName == '') {
            $this->errors[] = 'lastName is required';
        }

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[] = 'Invalid email';
        }

        if (strlen($this->message) > 255) {
            $this->errors[] = 'Please enter less than 255 characters for your message';
        }
    }

}
