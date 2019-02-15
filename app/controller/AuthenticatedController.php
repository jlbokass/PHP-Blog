<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 21/01/2019
 * Time: 14:43
 */

namespace App\Controller;

use Core\Controller;

abstract class AuthenticatedController extends Controller
{
    protected function before()
    {
        $this->requireLogin();
    }
}
