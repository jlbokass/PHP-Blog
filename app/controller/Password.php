<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 25/01/2019
 * Time: 06:50
 */

namespace App\Controller;


use App\Manager\UsersManager;
use Core\Controller;
use Core\View;

/**
 * Class Password
 * @package App\Controller
 */
class Password extends Controller
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function forgotAction()
    {
        View::renderTemplate('Password/forgot.html.twig');
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function requestResetAction()
    {
        UsersManager::sendPasswordReset($_POST['email']);

        View::renderTemplate('Password/reset_requested.html.twig');
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function resetAction()
    {
        $token = $this->route_params['token'];

        $user = $this->getUserOrExit($token);

        View::renderTemplate('Password/reset.html.twig', [
            'token' => $token

        ]);
    }

    /**
     *
     */
    public function resetPasswordAction()
    {
        $token = $_POST['token'];

        $user = $this->getUserOrExit($token);

        if ($user->resetPassword($_POST['password'])) {

            View::renderTemplate('Password/reset_success.html.twig');

        } else {

            View::renderTemplate('Password/reset.html.twig', [
                'token' => $token,
                'user' => $user
            ]);

        }
    }

    /**
     * @param $token
     * @return mixed
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    protected function getUserOrExit($token)
    {
        $user = UsersManager::findByPasswordReset($token);

        if ($user) {

            return $user;

        } else {

            View::renderTemplate('Password/token_expired.html.twig');
            exit;
        }
    }
}
