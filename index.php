<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Router.php';

$router = new Router();

$router->addRoute('/', 'RadioController@list');
$router->addRoute('/radio', 'RadioController@list');
$router->addRoute('/radio/message', 'RadioController@message');

try {
    $router->dispatch($_SERVER['REQUEST_URI']);
} catch (Exception $e) {
    http_response_code(404);
    echo "Erreur 404 : " . $e->getMessage();
}
