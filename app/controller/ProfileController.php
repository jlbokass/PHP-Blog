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
    public function showAction()
    {
        View::renderTemplate('Profile/show.html.twig', [
            'user' => Auth::getUser()
        ]);
    }

    public function editAction()
    {
        View::renderTemplate('Profile/edit.html.twig', [
            'user' => Auth::getUser()
        ]);
    }

    public function updateAction()
    {
        $user = Auth::getUser();

        /*
        $tata = new UsersManager();
        $tata->updateProfile($_POST);
        var_dump($tata);
        die();
        */

        if ($user->updateProfile($_POST)) {

            Flash::addMessage('changes saved');

            $this->redirect('/profile/show');

        }

        View::renderTemplate('Profile/show.html.twig', [
            'user' => $user
        ]);
    }

    public function articleAction()
    {
        $tatas = PostManager::getAllFromUser(Auth::getUser()->id);
        //var_dump($tatas);
        //die();

        View::renderTemplate('Profile/article.html.twig', [
            'tatas' => $tatas
        ]);
    }
}