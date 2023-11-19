<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
  case '/':
  case '':
    require "../controllers/HomeController.php";
    $controller = new HomeController();
    $controller->index();
    break;
  default:
    http_response_code(400);
    echo '404 - Página no encontrada';
    break;
}
