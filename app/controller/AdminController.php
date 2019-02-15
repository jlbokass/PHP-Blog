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

/**
 * Class AdminController
 *
 * PHP version 7.1
 *
 * @package App\Controller
 */
class AdminController extends AuthenticatedController
{

    /**
     * authenticate the admin
     *
     * @return void
     */
    protected function before()
    {
        parent::before();

        $user = Auth::getUser();

        if (! $user->role) {
            //$this->redirect('/profile/unauthorized');
            header('HTTP/1.1 403 Forbidden');
            echo 'You are not allowed to access that resource.';
            exit;
        }

    }

    public function unauthorizedAction()
    {
        View::renderTemplate('Profile/unauthorized.html.twig');
    }


    /**
     * render admin view
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function newAction()
    {
        View::renderTemplate('Admin/new.html.twig');
    }


    /**
     * index admin
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('Admin/index.html.twig', [
            'user' => Auth::getUser()
        ]);
    }


    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function authorizedAction()
    {
        View::renderTemplate('Admin/index.html.twig', [
            'user' => Auth::getUser()
        ]);
    }


    /**
     * Before filter - called before each action method
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showProfileAction()
    {
        View::renderTemplate('Admin/show-profile.html.twig', [
            'user' => $this->user
        ]);
    }


    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function editProfileAction()
    {
        View::renderTemplate('Admin/edit-profile.html.twig', [
            'user' => Auth::getUser()
        ]);
    }


    public function updateProfileAction()
    {
        if ($this->user->updateProfile($_POST)) {

            Flash::addMessage('Changes saved');

            $this->redirect('/admin/index');

        } else {

            View::renderTemplate('admin/edit.html', [
                'user' => $this->user
            ]);

        }
    }




    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
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
    public function newArticleAction()
    {
        $users = UsersManager::getAll();

        View::renderTemplate('Admin/new-article.html.twig', [
            'users' => $users
        ]);
    }

    /**
     *
     */
    public function createArticleAction()
    {
        $post = new PostManager($_POST);

        if ($post->save()) {
            Flash::addMessage('article created');
            $this->redirect('/admin/show-article');
        }
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

        if ($post->update($_POST)) {
            Flash::addMessage('the article was updated');

            $this->redirect('/admin/show-article');
        }

        View::renderTemplate('Profile/show-article.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function deleteArticle()
    {
        $users = UsersManager::getAll();
        $id = $this->route_params['id'];
        $single = PostManager::getSingle($id);

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
            Flash::addMessage('Article deleted');
            $this->redirect('/admin/show-article');
        } else {
            echo 'pb';
        }
    }



    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showCommentAction()
    {
        $comments = CommentManager::getAllComment();

        View::renderTemplate('Admin/show-comment.html.twig', [
            'comments' => $comments
        ]);
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function editCommentAction()
    {
        $id = $this->route_params['id'];

        $comment = CommentManager::getAComment($id);

        View::renderTemplate('/Admin/edit-comment.html.twig', [
            'comment' => $comment
        ]);
    }

    /**
     *
     */
    public function updateCommentAction()
    {
        $commentId = $_POST['comment_id'];

        CommentManager::update($commentId);

        Flash::addMessage('changes saved');

        $this->redirect('/admin/show-comment');
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function deleteCommentAction()
    {
        $id = $this->route_params['id'];

        $comment = CommentManager::getAComment($id);

        View::renderTemplate('/Admin/delete-comment.html.twig', [
            'comment' => $comment
        ]);
    }

    /**
     *
     */
    public function confirmDeleteCommentAction()
    {
        $commentId = $_GET['comment_id'];

        CommentManager::delete($commentId);

        Flash::addMessage('comment deleted');

        $this->redirect('/admin/show-comment');
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showUserAction()
    {
        $users = UsersManager::getAll();
        View::renderTemplate('Admin/show-user.html.twig', [
            'users' => $users
        ]);
    }






}
