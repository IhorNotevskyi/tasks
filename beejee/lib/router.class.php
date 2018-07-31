<?php

class Router
{
    protected $uri;

    protected $controller;

    protected $action;

    protected $params;

    protected $route;

    protected $methodPrefix;

    public function __construct($uri)
    {
        $this->uri = urldecode(trim($uri, '/'));

        // Get defaults
        $routes = Config::get('routes');
        $this->route = Config::get('default_route');
        $this->methodPrefix = isset($routes[$this->route]) ? $routes[$this->route] : '';

        $this->controller = Config::get('default_controller');
        $this->action = Config::get('default_action');

        $uriParts = explode('?', $this->uri);

        // Get path like /lng/controller/action/param1/param2/.../...
        $path = $uriParts[0];

        $pathParts = explode('/', $path);

//        echo '<pre>'; print_r($pathParts);

        if (count($pathParts)) {

            // Get route or language at first element
            if (in_array(strtolower(current($pathParts)), array_keys($routes))) {
                $this->route = strtolower(current($pathParts));
                $this->methodPrefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
                array_shift($pathParts);
            }

            // Get controller - next element of array
            if (current($pathParts)) {
                $this->controller = strtolower(current($pathParts));
                array_shift($pathParts);
            }

            // Get action
            if (current($pathParts)) {
                $this->action = strtolower(current($pathParts));
                array_shift($pathParts);
            }

            // Get params - all the rest
            $this->params = $pathParts;
        }
    }

    public static function redirect($location)
    {
        header("Location: $location");
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getMethodPrefix()
    {
        return $this->methodPrefix;
    }
}
