<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 12/01/2019
 * Time: 00:10
 */

class Router
{
    /**
     * @var array
     */
    protected $routes = [];

    /**
     * @var
     */
    protected $params;

    /**
     * @param $route
     * @param $params
     */
    public function add($route, $params)
    {
        $this->routes[$route] = $params;
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param $url
     * @return bool
     */
    public function match($url)
    {
        /*
        foreach ($this->routes as $route => $params) {
            if ($url == $route) {
                $this->params = $params;
                return true;
            }
        }
        */

        // Match to fixed URL format /controller/action
        $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";

        if (preg_match($reg_exp, $url, $matches)) {
            // Get named capture group values
            $params = [];

            foreach ($matches as $key => $match) {
                if (is_string($key)) {
                    $params[$key] = $match;
                }
            }

            $this->params = $params;
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

}