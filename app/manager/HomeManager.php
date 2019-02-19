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
 *
 * @package App\Manager
 *
 * PHP version 7.1
 */
class HomeManager
{



    public $firstName;

    public $lastName;

    public $email;

    public $message;

    public $errors = [];





    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }



    public function sendEmailToAdmin()
    {
        $this->validate();

        if (empty($this->errors)) {

            return true;
        }

        return false;
    }



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
