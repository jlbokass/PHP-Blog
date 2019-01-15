<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 13/01/2019
 * Time: 05:02
 */

namespace app\controller;


use Core\Controller;

/**
 * Class HomeController
 * @package app\controller
 */
class HomeController extends Controller
{
    /**
     *
     */
    public function indexAction()
    {
        echo ' Hello from the index in the HomeController! ';
    }

    protected function before()
    {
        echo '(before)';
        //return false;
    }

    protected function after()
    {
        echo '(after)';
    }
}
