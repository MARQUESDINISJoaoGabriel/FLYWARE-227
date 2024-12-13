<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>FLYWARE-227 Radio</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>FLYWARE-227 Radio</h1>
    <div id="radio-interface">
        <!-- Interface de la radio -->
    </div>
    <div id="messages">
        <?php foreach ($messages as $message): ?>
            <p><?php echo htmlspecialchars($message['content']); ?></p>
        <?php endforeach; ?>
    </div>
    <script src="js/script.js"></script>
</body>
</html>