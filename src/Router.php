<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        require_once 'view/home.php';
        break;

    case 'radio':
        require_once 'view/radioInterface.php';
        break;

    case 'logbook':
        require_once 'view/radioList.php';
        break;

    default:
        require_once 'view/404.php';
        break;
}
?>
