<?php

use Utils\Request;
use Utils\Response;

require_once "../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'\/../');
$dotenv->safeLoad();

require_once "./Library/Utils/Request.php";
require_once "./Library/Utils/Response.php";

$request = new Request();
$response = new Response();

$controllers_files = glob(__DIR__.'/Controllers/*.php');
foreach ($controllers_files as $c) {
    require_once $c;
}

if (count($request->params) >= 2) {
    $controller_name = "Controllers\\" . ucfirst($request->params[1]) . 'Controller';
} else {
    $controller_name = "";
}

if (class_exists($controller_name)) {
    $controller = new $controller_name();
    $controller->handle($request, $response);
} else {
    $response->setCode(404);
    $response->setData([
        'error' => "Controller not Found"
    ]);
}

header('Content-Type: application/json; charset=utf8');
http_response_code($response->code);
echo json_encode($response->data);
?>
