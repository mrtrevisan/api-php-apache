<?php

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$path = str_replace(["index.php/", "index.php"], "", parse_url($requestUri, PHP_URL_PATH));


echo json_encode([
    "method" => $method,
    "url" => $requestUri,
    "path" => $path
]);

?>
