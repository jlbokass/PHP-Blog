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
use App\Utilities\Flash;
use Core\View;

class AdminController extends AuthenticatedController
{

    protected function before()
    {
        parent::before();

        $user = Auth::getUser();

        if (! $user->role) {

            $this->redirect('/');
            /*header('HTTP/1.1 403 Forbidden');
            echo 'You are not allowed to access that resource.';
            exit;*/
        }
    }


    public function newAction()
    {
        View::renderTemplate('Admin/new.html.twig');
    }


    public function indexAction()
    {

        View::renderTemplate('Admin/index.html.twig', [
            'user' => Auth::getUser()
        ]);
        /*
        if(Auth::getUser()->role)
        {
            $this->redirect('admin/login-admin-success');

        } else {

            $this->redirect('admin/unauthorized');
        }
        */
    }



    public function authorizedAction()
    {
        View::renderTemplate('Admin/index.html.twig', [
            'user' => Auth::getUser()
        ]);
    }

    public function showProfileAction()
    {
        View::renderTemplate('Admin/show-profile.html.twig', [
            'user' => Auth::getUser()
        ]);
    }

    public function showArticleAction()
    {
        $posts = PostManager::getAll();

        View::renderTemplate('Admin/show-article.html.twig', [
            'posts' => $posts
        ]);
    }


    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function editArticleAction()
    {
        $users = UsersManager::getAll();
        $id = $this->route_params['id'];
        $single = PostManager::getSingle($id);

        View::renderTemplate('/Admin/edit-article.html.twig', [
            'single' => $single,
            'users' => $users
        ]);
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function updateArticleAction()
    {
        $post = new PostManager($_POST);

        if ($post->updateAPost($_POST)) {

            Flash::addMessage('changes saved');

            $this->redirect('/admin/show-article');

        }

        View::renderTemplate('Profile/show-article.html.twig', [
            'post' => $post
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

        CommentManager::update($commentId);

        Flash::addMessage('changes saved');

        $this->redirect('/admin/show-comment');
    }

    public function showUserAction()
    {
        $users = UsersManager::getAll();
        View::renderTemplate('Admin/show-user.html.twig', [
            'users' => $users
        ]);
    }

    public function deleteCommentAction()
    {
        $id = $this->route_params['id'];

        $comment = CommentManager::showSingle($id);

        View::renderTemplate('/Admin/delete-comment.html.twig', [
            'comment' => $comment
        ]);
    }

    public function confirmDeleteCommentAction()
    {
        $commentId = $_GET['comment_id'];

        CommentManager::delete($commentId);

        Flash::addMessage('changes saved');

        $this->redirect('/admin/show-comment');
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
            Flash::addMessage('changes saved');
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

        if ($post->delete()) {

            $this->redirect('/profile/show-article');

        } else {

            echo 'pb';
        }
    }

}