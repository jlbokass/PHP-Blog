<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 30/01/2019
 * Time: 03:21
 */

namespace App\Controller;


use App\Manager\ContactManager;
use Core\Controller;
use Core\View;

class ContactController extends Controller
{
    public function createAction()
    {
        $contact = new ContactManager($_POST);

        if ($contact->sendEmailToAdmin()) {

            $this->redirect('/contact/success');

        } else {

            View::renderTemplate('Contact/errors.html.twig', [
                'contact' => $contact
            ]);
        }
    }

    public function successAction()
    {
        View::renderTemplate('Contact/success.html.twig');
    }
}