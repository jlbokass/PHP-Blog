<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 13/01/2019
 * Time: 05:02
 */

namespace App\Controller;


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

        View::renderTemplate('/Home/index.html.twig');
    }

}
