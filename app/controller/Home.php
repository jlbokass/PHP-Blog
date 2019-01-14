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
        /*
        View::render('Home/index.php', [
            'name' => 'John',
            'colors' => ['red', 'green', 'blue']]);
        */

        View::renderTemplate('/Home/index.twig', [
            'name' => 'john',
            'colors' => ['red', 'blue', 'green']
        ]);
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
