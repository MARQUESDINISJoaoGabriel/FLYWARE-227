<?php
require '../controllers/Router.php';
require '../controllers/RadioController.php';
require '../controllers/LogbookController.php';
require '../models/MessageModel.php';
require '../models/LogbookModel.php';

$router = new Router();
$router->add('/', 'RadioController');
$router->add('/logbook', 'LogbookController');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($uri);
