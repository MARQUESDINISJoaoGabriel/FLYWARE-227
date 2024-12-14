<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Router.php';


use src\controller;
use src\Router;


$router = new Router();

$router->addRoute('/FLYWARE-227', 'RadioController@list');
$router->addRoute('/FLYWARE-227/radio/message', 'RadioController@message');
$router->addRoute('/FLYWARE-227/radio/interface', 'RadioController@interface');


try {
    $router->dispatch($_SERVER['REQUEST_URI']);
} catch (Exception $e) {
    http_response_code(404);
    echo "Erreur 404 : " . $e->getMessage();
}
