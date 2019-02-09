<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 26/01/2019
 * Time: 08:59
 */

namespace App\Controller;


use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UsersManager;
use App\Model\Post;
use App\Utilities\Auth;
use App\Utilities\Flash;
use Core\View;

/**
 * Class ProfileController
 * @package App\Controller
 */
class ProfileController extends AuthenticatedController
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showProfileAction()
    {
        if(Auth::getUser()->role) {

            View::renderTemplate('Admin/show-profile.html.twig', [
                'user' => Auth::getUser()
            ]);

        } else {

            View::renderTemplate('Profile/show-profile.html.twig', [
                'user' => Auth::getUser()
            ]);
        }
    }


    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function editProfileAction()
    {
        View::renderTemplate('Profile/edit-profile.html.twig', [
            'user' => Auth::getUser()
        ]);
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function updateProfileAction()
    {
        $user = Auth::getUser();

        if ($user->updateProfile($_POST)) {

            Flash::addMessage('changes saved');

            $this->redirect('/profile/show-profile');

        }

        View::renderTemplate('Profile/show-profile.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showArticleAction()
    {
        $posts = PostManager::getAll();

        View::renderTemplate('Profile/show-article.html.twig', [
            'posts' => $posts
        ]);

    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function NewArticleAction()
    {
        $users = UsersManager::getAll();

        View::renderTemplate('Profile/new-article.html.twig', [
            'users' => $users
        ]);
    }

    /**
     *
     */
    public function createArticleAction()
    {
        $post = new PostManager($_POST);
        //var_dump($post);

        if ($post->save()) {
            $this->redirect('/profile/show-article');
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

        View::renderTemplate('/Profile/edit-article.html.twig', [
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

            $this->redirect('/profile/show-article');

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
        $single = PostManager::getAll($id);

        View::renderTemplate('/Profile/delete-article.html.twig', [
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