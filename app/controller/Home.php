<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 13/01/2019
 * Time: 05:02
 */

namespace app\controller;


use Core\Controller;


use Core\View;

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
        //echo ' Hello from the index in the HomeController! ';
        View::render('home/index.php');
    }

    protected function before()
    {
        //echo '(before)';
        //return false;
    }

    protected function after()
    {
       // echo '(after)';
    }
}
