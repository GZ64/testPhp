<?php
require('../library/loader/Autoloader.php');
$config = parse_ini_file(__DIR__.'/../config.dist');

define('APP_ROOT', str_replace('public/index.php', '', $_SERVER['SCRIPT_FILENAME']));
define('DS', DIRECTORY_SEPARATOR);
define('API_URL', $config['URL']);

$autoloader = \library\loader\AutoLoader::getInstance();
$autoloader::setBasePath(str_replace('public', '', __DIR__));



$router = \library\core\Router::getInstance();
var_dump($_GET['get']);
$router::dispatchPage($_GET['p'], $_GET['get']);