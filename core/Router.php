<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 12/01/2019
 * Time: 00:10
 */

class Router
{
    protected $routes = [];

    protected $params;

    public function add($route, $params)
    {
        $this->routes[$route] = $params;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if ($url == $route) {
                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    public function getParams()
    {
        return $this->params;
    }

}