<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 17/01/2019
 * Time: 05:26
 */

namespace App\Controller;

use App\Manager\UsersManager;
use Core\Controller;
use Core\View;

/**
 * Class SignupController
 *
 * @package App\Controller
 *
 * PHP version 7.1
 */
class SignupController extends Controller
{

    public function newAction()
    {
        View::renderTemplate('Signup/new.html.twig');
    }


    public function createAction()
    {
        $user = new UsersManager($_POST);

        if ($user->save()) {

            $user->sendActivationEmail();

            $this->redirect('/signup/success');

        } else {

            View::renderTemplate('Signup/new.html.twig', [
                'user' => $user
            ]);
        }
    }


    public function successAction()
    {
        View::renderTemplate('Signup/success.html.twig');
    }


    public function activateAction()
    {
        UsersManager::activate($this->route_params['token']);

        $this->redirect('/signup/activated');
    }


    public function activatedAction()
    {
        View::renderTemplate('Signup/activated.html.twig');
    }
}
