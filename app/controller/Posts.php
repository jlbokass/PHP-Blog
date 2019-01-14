<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 13/01/2019
 * Time: 04:28
 */

namespace App\Controller;

use Core\Controller;

use Core\View;

/**
 * Class Posts
 * @package App\Controller
 */
class Posts extends Controller
{
    /**
     *
     */
    public function indexAction()
    {
        //echo 'Hello from the index action in the Posts ';
        View::renderTemplate('/Posts/index.twig');
    }

    /**
     *
     */
    public function addNewAction()
    {
        echo 'hello from the addnew action in the Posts';
    }

    /**
     *
     */
    public function editAction()
    {
        echo 'hello from the edit in Posts !';
        echo '<p><pre>' . htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }
}