<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 01/02/2019
 * Time: 23:53
 */

namespace App\Controller;

use Core\View;

class AdminController extends AuthenticatedController
{
    public function newAction()
    {
        // connexion form
        View::renderTemplate('Admin/new.html.twig');
    }

    public function indexAction()
    {
        View::renderTemplate('Admin/index.html.twig');
    }

    public function editProfileAction()
    {
        //
    }

    public function articleAction()
    {
        // show list of article
        View::renderTemplate('Admin/show.html.twig');
    }

    public function newArticle()
    {
        // create an article
    }

    public function editArticleAction()
    {
        //edit an article
        View::renderTemplate('Admin/article.html.twig');
    }

    public function deleteArticleAction()
    {
        //
    }



}