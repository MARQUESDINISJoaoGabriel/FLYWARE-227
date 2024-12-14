<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($message['title']) ?></title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <header>
        <h1>FLYWARE-227</h1>
    </header>
    <main>
        <div class="card">
            <h2><?= htmlspecialchars($message['title']) ?></h2>
            <p><?= htmlspecialchars($message['content']) ?></p>
        </div>
        <a href="/">Retour à la liste des messages</a>
    </main>
</body>
</html>
