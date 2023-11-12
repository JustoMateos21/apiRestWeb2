<?php
require_once 'config.php';
require_once 'libs/router.php';


require_once "app/controllers/product.api.controller.php";

$router = new Router();

$router->addRoute('products', 'GET', 'ProductApiController', 'get');
$router->addRoute('products/:ID', 'GET', 'ProductApiController', 'get');
$router->addRoute('products/:ID', 'PUT', 'ProductApiController', 'update');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
