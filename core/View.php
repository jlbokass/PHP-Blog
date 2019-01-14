<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 14/01/2019
 * Time: 13:58
 */

namespace Core;


/**
 * Class View
 * @package Core
 */
class View
{
    /**
     * Render a view file
     * @param string $view The view file
     *
     * @return void
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = '../app/view/' . $view; // Relative to core directory;
        if (is_readable($file)) {
            require $file;
        } else {
            echo $file . ' not found';
        }
    }
}