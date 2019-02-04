<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 26/01/2019
 * Time: 08:59
 */

namespace App\Controller;


use App\Manager\PostManager;
use App\Manager\UsersManager;
use App\Utilities\Auth;
use App\Utilities\Flash;
use Core\View;

class ProfileController extends AuthenticatedController
{
    public function showProfileAction()
    {
        View::renderTemplate('Profile/show-profile.html.twig', [
            'user' => Auth::getUser()
        ]);
    }


    public function editProfileAction()
    {
        View::renderTemplate('Profile/edit-profile.html.twig', [
            'user' => Auth::getUser()
        ]);
    }

    public function updateProfileAction()
    {
        $user = Auth::getUser();

        if ($user->updateProfile($_POST)) {

            Flash::addMessage('changes saved');

            $this->redirect('/profile/show');

        }

        View::renderTemplate('Profile/show-profile.html.twig', [
            'user' => $user
        ]);
    }

    public function showArticleAction()
    {
        $posts = PostManager::getAllFromUser(Auth::getUser()->id);

        View::renderTemplate('Profile/show-article.html.twig', [
            'posts' => $posts
        ]);
    }

    public function NewArticleAction()
    {
        View::renderTemplate('Profile/new-article.html.twig');
    }

    public function createArticleAction()
    {
        $post = new PostManager($_POST);
        //var_dump($post);

        if ($post->save()) {
            $this->redirect('/profile/show-article');
        }
    }

    public function editArticleAction()
    {
        //
    }
}