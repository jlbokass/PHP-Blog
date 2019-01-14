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
 * Class Home
 * @package app\controller
 */
class Home extends Controller
{
    /**
     *
     */
    public function indexAction()
    {
        //echo ' Hello from the index in the Home! ';
        View::render('Home/index.php', [
            'name' => 'John',
            'colors' => ['red', 'green', 'blue']]);
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
