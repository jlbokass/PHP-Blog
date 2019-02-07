<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 07/02/2019
 * Time: 17:53
 */

namespace App\Manager;

use Config\Config;

class HomeManager
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
        // firstName
        if ($this->firstName == '') {
            $this->errors[] = 'firstName is required';
        }

        // lastName
        if ($this->lastName == '') {
            $this->errors[] = 'lastName is required';
        }

        // email address
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[] = 'Invalid email';
        }

        // message
        if (strlen($this->message) > 10) {
            $this->errors[] = 'Please enter less than 200 characters for your message';
        }

    }

    public function emailFromTheBlog()
    {

        $text = View::getTemplate('Home/email.txt');
        $html = View::getTemplate('Home/email.html');

        Mail::send(Config::USER_NAME, 'Email from your blog', $text, $html);
    }
}