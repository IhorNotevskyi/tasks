<?php

class View
{
    protected $data;

    protected $path;

    public function __construct($data = [], $path = null)
    {
        if (!$path) {
            $path = self::getDefaultViewPath();
        }

        if (!file_exists($path)) {
            throw new Exception('Template file is not found in path: ' . $path);
        }

        $this->path = $path;
        $this->data = $data;
    }

    protected static function getDefaultViewPath()
    {
        $router = App::getRouter();
        if (!$router) {
            return false;
        }

        $controllerDir = $router->getController();
        $templateName = $router->getMethodPrefix() . $router->getAction() . '.php';

        return VIEWS_PATH . DS . $controllerDir . DS . $templateName;
    }

    public function render()
    {
        $data = $this->data;
        $user = unserialize(Session::get('user'));

        ob_start();
        include($this->path);
        $content = ob_get_clean();

        return $content;
    }
}