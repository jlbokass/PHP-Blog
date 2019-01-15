<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 14/01/2019
 * Time: 02:21
 */

namespace App\Controller\Admin;


use Core\Controller;

class User extends Controller
{
    protected function before()
    {
        // make shure the admin user is logged in for exemple
        // return false;
    }

    public function indexAction()
    {
        echo 'User admin index';
    }

    protected function after()
    {

    }
}