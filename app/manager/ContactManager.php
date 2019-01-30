<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 30/01/2019
 * Time: 03:20
 */

namespace App\Manager;


class ContactManager
{
    public $errors = [];

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
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
        // Username
        if ($this->firstName == '') {
            $this->errors[] = 'firstName is required';
        }

        // Username
        if ($this->lastName == '') {
            $this->errors[] = 'lastName is required';
        }

        // email address
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[] = 'Invalid email';
        }

    }
}