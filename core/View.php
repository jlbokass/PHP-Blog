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

        $file = '../app/view/' . $view;

        if (is_readable($file)) {

            require $file;

        }

        throw new \Exception($file . 'not found');
    }

    /**
     * @param $template
     * @param array $args
     */
    public static function renderTemplate($template, $args = [])
    {
        echo self::getTemplate($template, $args);
    }

    public static function getTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {

            $loader = new \Twig_Loader_Filesystem('../app/view');

            $twig = new \Twig_Environment($loader, [
                'cache' => false
            ]);

            $twig->addGlobal('current_user', Auth::getUser());
            $twig->addGlobal('flash_messages', Flash::getMessages());
        }

        return $twig->render($template, $args);
    }
}