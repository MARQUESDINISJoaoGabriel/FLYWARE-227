<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FLYWARE-227 Radio</title>
    <link rel="stylesheet" href="../../public/styles.css">
</head>
<body>
    <header>
        <h1>FLYWARE-227</h1>
        <p>Radio post-apocalyptique pour survivants</p>
    </header>
    <main>
        <?php foreach ($messages as $message): ?>
            <div class="card">
                <h2><?= htmlspecialchars($message['title']) ?></h2>
                <p><?= htmlspecialchars($message['content']) ?></p>
                <a href="/radio/message?id=<?= htmlspecialchars($message['id']) ?>">Lire plus</a>
            </div>
        <?php endforeach; ?>
    </main>
</body>
</html>
