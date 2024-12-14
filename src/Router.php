<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

$validPages = [
    'home' => 'view/home.php',
    'radio' => 'view/radioInterface.php',
    'logbook' => 'view/radioList.php'
];

if (array_key_exists($page, $validPages)) {
    require $validPages[$page];
} else {
    echo "Erreur 404 - Route Non Trouvée";
    exit;
}
