<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 13/01/2019
 * Time: 05:02
 */

namespace App\Controller;

use App\Manager\HomeManager;
use App\Model\Message;
use App\Utilities\Mail;
use Config\Config;
use Core\Controller;
use Core\View;

/**
 * Class Home
 * @package app\controller
 */
class HomeController extends Controller
{
    public function indexAction()
    {
        View::renderTemplate('/Home/index.html.twig');
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return void
     */
    public function emailAction()
    {
        $email = new HomeManager($_POST);

        if ($email->sendEmailToAdmin()) {

            $text = View::getTemplate('Home/email.txt', ['emailFromBlog' => $email]);
            $html = View::getTemplate('Home/email.html', ['emailFromBlog' => $email]);

            Mail::send(Config::USER_NAME, 'Blog PHP-MVC', $text, $html);

            $this->redirect('/home/success');

        } else {

            View::renderTemplate('Home/index.html.twig', [
                'emailFromBlog' => $email
            ]);
        }
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return void
     */
    public function successAction()
    {
        View::renderTemplate('Home/success.html.twig');
    }
}
