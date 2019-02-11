<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 01/02/2019
 * Time: 06:37
 */

namespace App\Controller;


use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UsersManager;
use App\Utilities\Auth;
use Core\View;

class CommentController extends AuthenticatedController
{
    public function createAction()
    {
        $comment = new CommentManager($_POST);


        //$postId = $_POST['post_id'];

        if ($comment->save()) {

            //$this->redirect('/post/' . $postId . '/single');
            $this->redirect('/comment/comment-request');

        } else {

            echo 'no';
        }
    }

    public function commentRequestAction()
    {
        View::renderTemplate('/Posts/comment_request.html.twig');
    }

    public function updateAction()
    {
        //
    }

    public function deleteAction()
    {
        //
    }

}