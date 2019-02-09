<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 01/02/2019
 * Time: 23:53
 */

namespace App\Controller;

use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UsersManager;
use App\Utilities\Auth;
use Core\View;

class AdminController extends AuthenticatedController
{

    public function newAction()
    {
        /*
        if(Auth::getUser()->role === 1)
        {
            View::renderTemplate('Admin/new.html.twig');
        } else {

            echo 'no';
        }
        */

    }

    public function showProfileAction()
    {
        if(Auth::getUser()->role)
        {
            View::renderTemplate('Admin/show-profile.html.twig', [
                'user' => Auth::getUser()
            ]);
        } else {

            View::renderTemplate('Admin/new.html.twig');
        }
    }

    public function showArticleAction()
    {
        $posts = PostManager::getAll();

        View::renderTemplate('Admin/show-article.html.twig', [
            'posts' => $posts
        ]);
    }

    public function showCommentAction()
    {
        $comments = CommentManager::getAll();
        View::renderTemplate('Admin/show-comment.html.twig', [
            'comments' => $comments
        ]);

    }

    public function editCommentAction()
    {
        $id = $this->route_params['id'];

        $comment = CommentManager::showSingle($id);

        View::renderTemplate('/Admin/edit-comment.html.twig', [
            'comment' => $comment
        ]);
    }

    public function updateCommentAction()
    {
        $commentId = $_POST['comment_id'];
        $comment = CommentManager::update($commentId);
        $this->redirect('/admin/show-comment');
    }

    public function showUserAction()
    {
        $users = UsersManager::getAll();
        View::renderTemplate('Admin/show-user.html.twig', [
            'users' => $users
        ]);
    }

    public function newArticleAction()
    {
        $users = UsersManager::getAll();

        View::renderTemplate('Admin/new-article.html.twig', [
            'users' => $users
        ]);
    }

    public function createArticleAction()
    {
        $post = new PostManager($_POST);

        if ($post->save()) {
            $this->redirect('/admin/show-article');
        }
    }

    public function deleteArticle()
    {
        $users = UsersManager::getAll();
        $id = $this->route_params['id'];
        $single = PostManager::getAll($id);

        View::renderTemplate('/Admin/delete-article.html.twig', [
            'single' => $single,
            'users' => $users
        ]);
    }


    /**
     *
     */
    public function deleteArticleConfirmationAction()
    {
        $post = new PostManager($_POST);
        $comment = new CommentManager($_POST);

        if ($post->delete() AND $comment->delete()) {

            $this->redirect('/profile/show-article');

        } else {

            echo 'pb';
        }
    }

}