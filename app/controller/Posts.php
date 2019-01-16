<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 13/01/2019
 * Time: 04:28
 */

namespace App\Controller;

use App\Model\Post;

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
        $posts = Post::getAll();
        View::renderTemplate('/Posts/index.twig', [
            'posts' => $posts
        ]);
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