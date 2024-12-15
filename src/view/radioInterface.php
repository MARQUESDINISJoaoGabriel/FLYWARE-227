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
    <title>FLYWARE-227</title>
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
    <h1>FLYWARE-227</h1>
    <a href="Router.php?page=home" style="color: #00ffcc;">[ACCEUIL]</a>

    <div class="radio-container">
        <p id="frequency-display">[FREQUENCE: 187.0 MHz]</p>
        <input type="range" min="0" max="375" step="0.1" value="187" id="frequency" class="slider">
        
        <div id="message">...</div>
        <br><br><hr><hr><br><br>

        <form method="POST" id="logbook-form" style="display:none;">
            <input type="hidden" name="frequency" id="hidden-frequency">
            <input type="hidden" name="message" id="hidden-message">
            <button type="submit">[ ENREGISTRER ]</button>
        </form>
        
        <div id="static-noise" class="static-noise"></div>
        
        <div id="wave-effect" class="wave-effect"></div>

        <div id="static-noiseEFFECT" class="static-noiseEFFECT"></div>
    </div>

    <script>

        const audio = new Audio('../assets/RadioStatic.mp3');
        audio.load();
        audio.loop = true;
        audio.play();

        // PARTIE BACKEND
        const zones = [
            { min: 70, max: 80, text: "Ici Delta 7 - Tempête en approche... Vers CRASHSITE - Consultez..." },
            { min: 30, max: 40, text: "Évacuation disponible,    secteur 9 Zone 48" },
            { min: 90, max: 100, text: "Tu disais quoi Jack..?            C'est complètement...     malade ce qu'il se passe..." },
            { min: 136, max: 166, text: "C'est compliqué en ce moment        je sais,               depuis le crashdown du COLLAPSE-21,       c'est L'agency qui..." },
            { min: 180, max: 190, text: "Fréquence de secours     disponible, standby." },
            { min: 200, max: 210, text: "Je ne suis plus...               C'est pas (?????)..." },
            { min: 260, max: 270, text: ". . . - - - . . ." },
            { min: 300, max: 315, text: "ZETA, DOUZE, U,   V,    B,   SEPTA,     SIXANTE,                       DELTA, ECHO, ECHO, RALLY.     DIX-SEPT,   CINQ,    DOUZE,     SOIXANTE,   " },
        ];
        
        const slider = document.getElementById('frequency');
        const messageDiv = document.getElementById('message');
        const freqDisplay = document.getElementById('frequency-display');
        const logbookForm = document.getElementById('logbook-form');
        const hiddenFrequency = document.getElementById('hidden-frequency');
        const hiddenMessage = document.getElementById('hidden-message');
        const staticNoiseDiv = document.getElementById('static-noise');
        const waveEffectDiv = document.getElementById('wave-effect');

        let staticInterval;
        let waveInterval;

        function typeMessage(message, element) {
    let index = 0;
    element.textContent = '';
    const interval = setInterval(() => {
        if (index < message.length) {
            element.textContent += message[index];
            index++;
        } else {
            clearInterval(interval);
        }
    }, 50);
}

slider.addEventListener('input', () => {
    const freq = parseFloat(slider.value).toFixed(1);
    freqDisplay.textContent = `[FREQUENCE: ${freq} MHz]`;
    messageDiv.textContent = "...";
    logbookForm.style.display = "none";
    staticNoiseDiv.style.display = "block";
    waveEffectDiv.style.display = "none";

    zones.forEach(zone => {
        if (freq >= zone.min && freq <= zone.max) {
            typeMessage(zone.text, messageDiv);
            hiddenFrequency.value = freq;
            hiddenMessage.value = zone.text;
            logbookForm.style.display = "block";
            staticNoiseDiv.style.display = "none";
            waveEffectDiv.style.display = "block";
            startWaveEffect();
        }
    });
});

        function generateStaticNoise() {
            const characters = ['*', '#', '    ', '@', '   ', '   ', '!', '.', '-', ' '];
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

        function generateWaveEffect() {
            const characters = ['-',' ','~','  '];
            let noise = '';
            for (let i = 0; i < 30; i++) {
                for (let j = 0; j < 100; j++) {
                    noise += characters[Math.floor(Math.random() * characters.length)];
                }
                noise += '\n';
            }
            waveEffectDiv.textContent = noise;
        }

        function startWaveEffect() {
            if (waveInterval) clearInterval(waveInterval);
            waveInterval = setInterval(generateWaveEffect, 45);
        }

        startStaticNoise();
    </script>
</body>
</html>
