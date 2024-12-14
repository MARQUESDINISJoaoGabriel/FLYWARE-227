<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Router.php';
use \src\Router;

$router = new Router();

$router->addRoute('/FLYWARE-227', 'RadioController@list');
$router->addRoute('/', 'RadioController@list');
$router->addRoute('/radio', 'RadioController@list');
$router->addRoute('/radio/message', 'RadioController@message');
$router->addRoute('/radio/interface', 'RadioController@interface');

try {
    $router->dispatch($_SERVER['REQUEST_URI']);
} catch (Exception $e) {
    http_response_code(404);
    echo "Erreur 404 : " . $e->getMessage();
}
