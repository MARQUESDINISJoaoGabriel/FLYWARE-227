<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        require_once 'view/home.php';
        break;

    case 'radio':
        require_once 'controller/RadioController.php';
        $controller = new RadioController();

        // Différencier les sous-actions
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['clear_logbook'])) {
                $controller->clearLogbook();
            } else {
                $controller->handleRequest();
            }
        } else {
            $controller->showRadioPage();
        }
        break;

    case 'logbook':
        require_once 'controller/RadioController.php';
        $controller = new RadioController();
        $controller->showLogbook();
        break;

    default:
        require_once 'view/404.php';
        break;
}
?>
