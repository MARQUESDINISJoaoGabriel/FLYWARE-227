<?php
$logs = file_exists('../../logbook.txt') ? file('../../logbook.txt') : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_logbook'])) {
    file_put_contents('../../logbook.txt', '');
    $logs = [];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>FLYWARE-227</title>
    <style>
        body {
            background: black;
            color: #e0e0e0;
            font-family: 'Courier New', monospace;
            text-align: center;
        }
        
        .log-entry {
            margin: 10px;
            padding: 10px;
            background: #222;
            border: 1px solid #333;
        }

        button {
            background-color:#00ffcc;
            color: black;
            border: none;
            cursor: pointer;
            font-family: 'Courier New', monospace;
            font-size: 1.2rem;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        #static-noiseEFFECT {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: repeating-linear-gradient(
                transparent, 
                transparent 2px, 
                rgba(255, 255, 255, 0.2) 2px, 
                rgba(255, 255, 255, 0.2) 4px
            );
            opacity: 0.15;
            z-index: -4;
            animation: noise-animation 0.15s infinite;
        }

        @keyframes noise-animation {
            0% { transform: translate(0, 0); }
            25% { transform: translate(-5px, 5px); }
            50% { transform: translate(5px, -5px); }
            75% { transform: translate(-5px, -5px); }
            100% { transform: translate(5px, 5px); }
        }

    </style>
</head>
<body>
    <!-- Headers -->
    <h1>FLYWARE-227</h1>
    <a href="Router.php?page=home" style="color: #00ffcc;">Retour à l'accueil</a>
    <form method="POST" id="clear-form">
    <!-- Bouton d'effacement -->
    <button type="submit" name="clear_logbook" id="play-sound">Effacer toutes les entrées</button>
    </form>


    <!-- Messages -->
    <div>
        <?php if (!empty($logs)): ?>
            <?php foreach ($logs as $entry): ?>
                <div class="log-entry"><?php echo htmlspecialchars($entry); ?></div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun message enregistré.</p>
        <?php endif; ?>
    </div>
    <div id="static-noiseEFFECT" class="static-noiseEFFECT"></div>

    
    <script>
    const audio = new Audio('../assets/ComputerWarn.mp3');
    audio.load();

    const button = document.getElementById('play-sound');

    audio.play();
</script>

</body>
</html>
