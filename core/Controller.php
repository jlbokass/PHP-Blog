<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 13/01/2019
 * Time: 05:33
 */

namespace Core;


/**
 * Class Controller
 * @package Core
 */
abstract class Controller
{
    /**
     * Parameters from the matched route
     * @var array
     */
    protected $route_params = [];

    /**
     * Class constructor
     *
     * @param array $route_params  Parameters from the route
     *
     * @return void
     */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    /**
     * @param $name
     * @param $arguments
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $arguments);
                $this->after();
            }
        } else {
            //echo 'Method ' . $method . 'not found in controller ' . get_class($this);
            throw new \Exception('Method ' . $method . ' not found in controller ' . get_class($this));
        }
    }

    /**
     *
     */
    protected function before()
    {

    }

    /**
     *
     */
    protected  function after()
    {

    }
}