<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 22/01/2019
 * Time: 11:05
 */

namespace App\Controller;


use Core\Controller;
use Core\View;

class Cv extends Controller
{
    public function indexAction()
    {
        View::renderTemplate('/Cv/index.html.twig');
    }
}