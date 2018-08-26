<?php

class App
{
    protected static $router;

    public static $db;

    public static function getRouter()
    {
        return self::$router;
    }

    public static function run($uri)
    {
        self::$router = new Router($uri);

        self::$db = new DB(Config::get('db.host'), Config::get('db.user'), Config::get('db.password'), Config::get('db.db_name'));

        $controllerClass = ucfirst(self::$router->getController()) . 'Controller';
        $controllerMethod = strtolower(self::$router->getMethodPrefix() . self::$router->getAction());

        $layout = self::$router->getRoute();

        // Calling controller's method
        $controllerObject = new $controllerClass();
        if (method_exists($controllerObject, $controllerMethod)) {
            // Controller's action may return a view path
            $viewPath = $controllerObject->$controllerMethod();
            $viewObject = new View($controllerObject->getData(), $viewPath);
            $content = $viewObject->render();
        } else {
            throw new Exception('Method ' . $controllerMethod . ' of class ' . $controllerClass . ' does not exist');
        }

        $layout = self::$router->getRoute();
        $layoutPath = VIEWS_PATH . DS . $layout . '.php';
        $layoutViewObject = new View(compact('content'), $layoutPath);
        echo $layoutViewObject->render();
    }
}