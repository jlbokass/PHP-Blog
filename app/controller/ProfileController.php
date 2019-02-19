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
 *
 * PHP version 7.1
 */
class ProfileController extends AuthenticatedController
{
    /**
     * Before filter - called before each action method
     *
     * @return void
     */
    protected function before()
    {
        parent::before();

        $this->user = Auth::getUser();
    }

    /**
     * Show the profile
     *
     * @return void
     */
    public function showProfileAction()
    {
        View::renderTemplate('Profile/show-profile.html.twig', [
        'user' => $this->user
    ]);
    }


    /**
     * Show the form for editing the profile
     *
     * @return void
     */
    public function editProfileAction()
    {
        View::renderTemplate('Profile/edit-profile.html.twig', [
            'user' => Auth::getUser()
        ]);
    }

    /**
     * Update the profile
     *
     * @return void
     */
    public function updateProfileAction()
    {
        if ($this->user->updateProfile($_POST)) {

            Flash::addMessage('Changes saved');

            $this->redirect('/profile/show-profile');

        } else {

            View::renderTemplate('Profile/edit.html', [
                'user' => $this->user
            ]);
        }
    }
}
