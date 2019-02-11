<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 17/01/2019
 * Time: 05:26
 */

namespace App\Controller;

use App\Model\User;
use Core\Controller;
use Core\View;

class Signup extends Controller
{
    public function newAction()
    {
        View::renderTemplate('Signup/new.twig');
    }

    public function createAction()
    {
         $user = new User($_POST);

         if ($user->save()) {

             View::renderTemplate('Signup/success.twig');

         } else {
             View::renderTemplate('Signup/new.twig', ['user' => $user]);
         }
    }

    public function successAction()
    {
        View::renderTemplate('Signup/success.twig');
    }
}