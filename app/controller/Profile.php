<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 26/01/2019
 * Time: 08:59
 */

namespace App\Controller;


use App\Utilities\Auth;
use App\Utilities\Flash;
use Core\View;

class Profile extends Authenticated
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

        if ($user->updateProfile($_POST)) {

            Flash::addMessage('changes saved');

            $this->redirect('/profile/show');

        }

        View::renderTemplate('Profile/edit.html.twig', [
            'user' => $user
        ]);
    }
}