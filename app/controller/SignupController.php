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
    /**
     * Show signup page
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return void
     */
    public function newAction()
    {
        View::renderTemplate('Signup/new.html.twig');
    }

    /**
     * Signup a new user
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return void
     */
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

    /**
     * Show the signup success page
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return void
     */
    public function successAction()
    {
        View::renderTemplate('Signup/success.html.twig');
    }

    /**
     * Activate a new account
     *
     * @return void
     */
    public function activateAction()
    {
        UsersManager::activate($this->route_params['token']);
        $this->redirect('/signup/activated');
    }

    /**
     * Show the activation success page
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return void
     */
    public function activatedAction()
    {
        View::renderTemplate('Signup/activated.html.twig');
    }
}
