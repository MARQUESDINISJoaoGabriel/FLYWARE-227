<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'], $_POST['frequency'])) {
    $message = htmlspecialchars($_POST['message']);
    $frequency = htmlspecialchars($_POST['frequency']);
    $timestamp = date('Y-m-d H:i:s');

    $entry = "[$timestamp] Fréquence : $frequency MHz - Message : $message" . PHP_EOL;

    file_put_contents('../../logbook.txt', $entry, FILE_APPEND);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FLYWARE-227 - Radio</title>
    <link rel="stylesheet" href="/public/styles.css">
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color:rgb(0, 0, 0);
            color: #e0e0e0;
            text-align: center;
            margin: 0;
            padding: 0;
            animation: backgroundNoise 5s infinite;
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

        .radio-container {
            margin-top: 50px;
        }

        .ascii-signal {
            font-size: 1.2rem;
            white-space: pre;
            color: #0ff;
            line-height: 1.2;
            margin: 20px auto;
            letter-spacing: 2px;
        }

        .slider {
            width: 50%;
            margin: 20px auto;
        }

        .frequency-display {
            font-size: 1.5rem;
            color: #fff;
            margin: 10px 0;
        }

        .message {
            font-size: 1.3rem;
            color: #ff4500;
            min-height: 40px;
            animation: blink 1s infinite;
        }

        button {
            padding: 10px;
            background: #00ffcc;
            color: black;
            border: none;
            cursor: pointer;
            animation: pulse 1.5s infinite;
        }

        .static-noise {
            font-family: monospace;
            color: #00ffcc;
            white-space: pre;
            margin-top: 20px;
            font-size: 1rem;
            letter-spacing: 1px;
            height: 150px;
            overflow: hidden;
        }

        .wave-effect {
            font-family: monospace;
            color: #00ffcc;
            white-space: pre;
            margin-top: 20px;
            font-size: 1rem;
            letter-spacing: 1px;
            height: 150px;
            overflow: hidden;
            display: none;
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
    <h1>PAGE NON TROUVEE</h1>
    <a href="Router.php?page=home" style="color: #00ffcc;">Retour à l'accueil</a>
        
        <div id="static-noise" class="static-noise"></div>
        
        <div id="wave-effect" class="wave-effect"></div>

        <div id="static-noiseEFFECT" class="static-noiseEFFECT"></div>
    </div>

    <script>
        function generateStaticNoise() {
            const characters = ['*', '    ', '    ', '@', '   ', '   ', '     ', '.', '-', ' '];
            let noise = '';
            for (let i = 0; i < 30; i++) {
                for (let j = 0; j < 100; j++) {
                    noise += characters[Math.floor(Math.random() * characters.length)];
                }
                noise += '\n';
            }
            staticNoiseDiv.textContent = noise;
        }

        function startStaticNoise() {
            staticInterval = setInterval(generateStaticNoise, 100);
        }

        startStaticNoise();
    </script>
</body>
</html>
