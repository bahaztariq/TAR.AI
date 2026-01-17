<?php

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = [
    '/' => 'views/chat.php',
    '/api/chat' => 'api/chat.php',
];

if (array_key_exists($requestUri, $routes)) {
    require_once __DIR__ . '/' . $routes[$requestUri];
} else {
    http_response_code(404);
    echo "404 Not Found";
}
