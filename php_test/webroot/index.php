<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('VIEWS_PATH', ROOT . DS . 'views');

require_once ROOT . DS . 'lib' . DS . 'loader.class.php';
spl_autoload_register([(new Loader()), 'autoloader']);

session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

App::run($_SERVER['REQUEST_URI']);
