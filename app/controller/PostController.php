<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 13/01/2019
 * Time: 04:28
 */

namespace App\Controller;

use Core\Controller;

/**
 * Class PostController
 * @package App\Controller
 */
class PostController extends Controller
{
    /**
     *
     */
    public function indexAction()
    {
        echo 'Hello from the index action in the PostController ';
        echo '<p>Query string parameters : <pre>' . htmlspecialchars(print_r($_GET, true)) .'</pre></p>';
    }

    /**
     *
     */
    public function addNewAction()
    {
        echo 'hello from the addnew action in the PostController';
    }

    /**
     *
     */
    public function editAction()
    {
        echo 'hello from the edit in PostController !';
        echo '<p><pre>' . htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }
}