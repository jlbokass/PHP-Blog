<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 13/01/2019
 * Time: 04:28
 */

namespace App\Controller;

class PostController
{
    public function index()
    {
        echo 'Hello from the index action in the PostController ';
        echo '<p>Query string parameters : <pre>' . htmlspecialchars(print_r($_GET, true)) .'</pre></p>';
    }

    public function addNew()
    {
        echo 'hello from the addnew action in the PostController';
    }
}