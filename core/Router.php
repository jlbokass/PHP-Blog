<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 04/01/2019
 * Time: 14:19
 */

class Router
{



    public function run()
    {
        $page = 'home';

//router
        if (isset($_GET['route']))
        {
            $page = $_GET['route'];
        }

// rendu du template
        $loader = new Twig_Loader_Filesystem('../app/view/front');
        $twig = new Twig_Environment($loader, [
            'cache' => false // ../core/temp'
        ]);


        switch ($page)
        {
            case 'home' :
                echo $twig->render('home.twig');
                break;

            case 'posts' :
                echo $twig->render('posts.twig');
                break;

            case 'single' :
                echo $twig->render('single.twig');
                break;

            case 'inscription' :
                echo $twig->render('register.twig');
                break;

            case 'connexion' :
                echo $twig->render('connexion.twig');
                break;

            case 'cv' :
                echo $twig->render('cv.twig');
                break;

            case 'contact' :
                echo $twig->render('contact.twig');
                break;

            default :
                header('HTTP/1.0 404 not found');
                echo $twig->render('404.twig');
                break;
        }
    }
}