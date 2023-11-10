<?php

require_once "libs/router.php";

$router = new Router();

$router->addRoute('tareas', 'GET', 'TaskApiController', 'GetAll');

$router->route($_GET["resources"], $_SERVER['REQUEST_METHOD']);


?>