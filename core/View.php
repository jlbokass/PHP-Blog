<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 14/01/2019
 * Time: 13:58
 */

namespace Core;

use App\Utilities\Auth;
use App\Utilities\Flash;

/**
 * Class View
 * @package Core
 */
class View
{


    /**
     * @param $view
     * @param array $args
     * @throws \Exception
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = '../app/view/' . $view; // Relative to core directory;
        if (is_readable($file)) {
            require $file;
        } else {
            //echo $file . ' not found';
            throw new \Exception($file . 'not found');
        }
    }

    /**
     * @param $template
     * @param array $args
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public static function renderTemplate($template, $args = [])
    {
        echo static::getTemplate($template, $args);
    }

    public static function getTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig_Loader_Filesystem('../app/view');
            $twig = new \Twig_Environment($loader, [
                'cache' => false
            ]);
            //$twig->addGlobal('session', $_SESSION);
            //$twig->addGlobal('is_logged_in', \App\Auth::isLoggedIn());
            $twig->addGlobal('current_user', Auth::getUser());
            $twig->addGlobal('flash_messages', Flash::getMessages());
        }

        return $twig->render($template, $args);
    }
}