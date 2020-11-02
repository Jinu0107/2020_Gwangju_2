<?php

use src\App\Route;

session_start();

define("__DS", "/");
define("__ROOT", dirname(__DIR__));
define("__SRC", __ROOT . __DS . 'src');
define("__VIEWS", __ROOT . __DS . 'views');
define("__IMAGE", dirname(__ROOT . '../') . "/festivalImages");

function myLoader($name)
{
    require_once(__ROOT . __DS . str_replace("\\", "/", $name) . ".php");
}

spl_autoload_register("myLoader");

require_once(__ROOT . __DS . 'web.php');

Route::init();
