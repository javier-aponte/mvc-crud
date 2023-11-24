<?php

use controllers\ProductController;

require '../controllers/ProductController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$controller = new ProductController();

switch ($request) {
    case '/':
    case '':
        $controller->list();
        break;
    case '/create':
        if ($method == 'GET') {
            $controller->create();
        } elseif ($method == 'POST') {
            $controller->store();
        }
        break;
    case (bool)preg_match('/\/edit\/([0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12})/', $request, $matches):
        $uuid = $matches[1];
        if ($method == 'GET') {
            $controller->edit($uuid);
        } elseif ($method == 'POST') {
            $controller->update($uuid);
        }
        break;
    case '/edit':
        if ($method == 'POST') {
            $controller->update();
        }
        break;
    /* case (preg_match('/\/delete\/(\d+)/', $request, $matches) ? true : false):
    $id = $matches[1];
    if ($method == 'POST') {
      $controller->delete($id);
    }
    break; */
    default:
        http_response_code(404);
        echo '404 - Página no encontrada';
        break;
}
