<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 11/01/2019
 * Time: 23:39
 */

//echo 'REQUEST URL : ' . $_SERVER['QUERY_STRING'];

require '../core/Router.php';

$route = new Router();

//echo get_class($route);

// Add the routes
$route->add('', ['controller' => 'Home', 'action' => 'index']);
$route->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$route->add('{controller}/{action}');
$route->add('{controller}/{id:\d+}/{action}');

// Display the routing table
echo '<pre>';
//var_dump($router->getRoutes());
echo htmlspecialchars(print_r($route->getRoutes(), true));
echo '</pre>';


// Match the requested route
$url = $_SERVER['QUERY_STRING'];

if ($route->match($url)) {
    echo '<pre>';
    var_dump($route->getParams());
    echo '</pre>';
} else {
    echo "No route found for URL '$url'";
}