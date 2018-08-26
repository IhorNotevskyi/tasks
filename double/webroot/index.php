<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('VIEWS_PATH', ROOT . DS . 'views');

require_once ROOT . DS . 'lib' . DS . 'loader.class.php';
spl_autoload_register([(new Loader()), 'autoloader']);

try {
    App::run($_SERVER['REQUEST_URI']);
} catch (Exception $e) {
    Router::redirect('/error/message');
}
