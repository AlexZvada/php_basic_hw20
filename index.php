<?php
session_start();
const APP_DIR = __DIR__ . '/';
const CONTROLLERS_DIR = APP_DIR . "controllers/";
const VIEWS_DIR = APP_DIR . "views/";

require_once APP_DIR ."functions.php";
require_once APP_DIR . "system/Request.php";
require_once APP_DIR . "system/Response.php";
require_once APP_DIR . "system/Router.php";
require_once APP_DIR . "system/View.php";
require_once APP_DIR . "system/Session.php";
require_once APP_DIR . "traits/Validator.php";


$router = new Router();
$router->addRoute('/', [
    'get'=>'HomeController@index',

]);
$router->addRoute('/addition', [
    'post'=>'AdditionController@index'
]);

try {
    $router->processRoute(Request::getUrl(), Request::getMethod());
} catch (Exception $exception) {
    echo $exception->getMessage();
}

session_destroy();


