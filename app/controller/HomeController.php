<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 13/01/2019
 * Time: 05:02
 */

namespace App\Controller;

use App\Manager\ContactManager;
use Core\Controller;
use Core\View;

/**
 * Class Home
 * @package app\controller
 */
class HomeController extends Controller
{
    /**
     *
     */
    public function indexAction()
    {

        View::renderTemplate('/Home/index.html.twig');
    }

    public function emailAction()
    {
        $emailFromBlog = new ContactManager($_POST);

        if ($emailFromBlog->sendEmailToAdmin()) {

            $this->redirect('/home/success');

        } else {

            View::renderTemplate('Home/index.html.twig', [
                'emailFromBlog' => $emailFromBlog
            ]);
        }
    }

    public function successAction()
    {
        View::renderTemplate('Home/success.html.twig');
    }

}
