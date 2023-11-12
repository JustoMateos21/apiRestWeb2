<?php
require_once 'config.php';
require_once 'libs/router.php';


require_once "app/controller/product.api.controller.php";

$router = new Router();

$router->addRoute('product', 'GET', 'ProductApiController', 'get');
$router->addRoute('products', 'GET', 'ProductApiController', 'get');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
