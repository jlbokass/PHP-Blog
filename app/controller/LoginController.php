<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 20/01/2019
 * Time: 15:30
 */

namespace App\Controller;

use App\Utilities\Auth;
use App\Utilities\Flash;
use App\Model\User;
use Core\Controller;
use Core\View;
use App\Manager\UsersManager;

/**
 * Class Login
 * @package App\Controller
 */
class LoginController extends Controller
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function newAction()
    {
        View::renderTemplate('Login/new.html.twig');
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function createAction()
    {
        $user = UsersManager::authenticate($_POST['email'], $_POST['password']);

        $remember_me = isset($_POST['remember_me']);

        if ($user) {

            Auth::login($user, $remember_me);

            Flash::addMessage('Login successful');

            $this->redirect(Auth::getReturnToPage());

        } else {

            //Flash::addMessage('login unsuccessful, please try again');

            Flash::addMessage('Login unsuccessful, please try again', Flash::WARNING);

            View::renderTemplate('Login/new.html.twig', [
                'email' => $_POST['email'],
                'remember_me' => $remember_me
            ]);
        }
    }

    /**
     *
     */
    public function destroyAction()
    {
        Auth::logout();

        $this->redirect('/login/show-logout-message');
    }


    /**
     *
     */
    public function showLogoutMessageAction()
    {
        Flash::addMessage('logout successful');

        $this->redirect('/');
    }
}