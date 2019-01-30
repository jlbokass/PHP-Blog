<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 20/01/2019
 * Time: 23:11
 */

namespace App\Controller;

use Core\View;

class Item extends Authenticated
{

    public function indexAction()
    {
        View::renderTemplate('Item/index.html.twig');
    }

    public function showAction()
    {
        echo ' show action';
    }

    public function newAction()
    {
        echo ' new action';
    }
}