<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 13/01/2019
 * Time: 04:28
 */

namespace App\Controller;

use App\Manager\CommentManager;
use App\Manager\PostManager;
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
        $posts = PostManager::getAll();

        View::renderTemplate('/Posts/index.html.twig', [
            'posts' => $posts
        ]);
    }

    public function singleAction()
    {
        $id = $this->route_params['id'];

        $posts = PostManager::getAll($id);
        $single = PostManager::getSingle($id);
        $comments = CommentManager::getAll($id);

        View::renderTemplate('/Posts/single.html.twig', [
            'posts' => $posts,
            'single' => $single,
            'comments' => $comments
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

    public function updateAction()
    {
        //...
    }

    public function delete()
    {

    }

    public function headlineAction($posts)
    {
         //...
    }
}