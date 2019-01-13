<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 04/01/2019
 * Time: 08:28
 */
require '../vendor/autoload.php';
require '../core/config.php';
require '../core/db.php';
require '../core/Router.php';


$route = new Router();
$route->run();


