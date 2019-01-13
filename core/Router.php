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
    public function add($route, $params = [])
    {
        // $this->routes[$route] = $params;

        // Convert route to regex : escape forward slashes
        $route  = preg_replace('/\//', '\\/', $route);

        //Convert variable e.g {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

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
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // Get named capture group values
                //$params = [];

                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
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