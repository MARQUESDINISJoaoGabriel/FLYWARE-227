<?php
$logs = file_exists('../../logbook.txt') ? file('../../logbook.txt') : [];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>LogBook</title>
    <style>
        body { background: black; color: #e0e0e0; font-family: 'Courier New', monospace; text-align: center; }
        .log-entry { margin: 10px; padding: 10px; background: #222; border: 1px solid #333; }
    </style>
</head>
<body>
    <h1>LogBook</h1>
    <a href="Router.php?page=home" style="color: #00ffcc;">Retour à l'accueil</a>
    <div>
        <?php if (!empty($logs)): ?>
            <?php foreach ($logs as $entry): ?>
                <div class="log-entry"><?php echo htmlspecialchars($entry); ?></div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun message enregistré.</p>
        <?php endif; ?>
    </div>
</body>
</html>
