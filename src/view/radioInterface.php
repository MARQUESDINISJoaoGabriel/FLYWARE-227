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
        }
    </style>
</head>
<body>
    <header>
        <h1>FLYWARE-227</h1>
        <p>Radio post-apocalyptique</p>
    </header>

    <div class="radio-container">
        <!-- Affichage de la fréquence actuelle -->
        <div class="frequency-display" id="frequency-display">
            Fréquence : 50.0 MHz
        </div>

        <!-- Zone ASCII pour les ondes -->
        <div class="ascii-signal" id="ascii-signal">
            ...
        </div>

        <!-- Curseur pour la fréquence -->
        <input type="range" min="0" max="100" step="0.1" value="50" class="slider" id="frequency">

        <!-- Texte du message capté -->
        <div class="message" id="message">...</div>
    </div>

    <script>
        const frequencyZones = [
            { min: 70, max: 80, text: "Alerte ! Tempête en approche...", signalType: "high" },
            { min: 30, max: 40, text: "Évacuation imminente... Secteur 9.", signalType: "low" }
        ];

        const slider = document.getElementById('frequency');
        const asciiSignalDiv = document.getElementById('ascii-signal');
        const messageDiv = document.getElementById('message');
        const frequencyDisplay = document.getElementById('frequency-display');

        let animationInterval;
        let staticNoiseInterval;
        let messageInterval; // Pour l'animation du message
        let currentMessage = null; // Gérer l'état du message
        let isInMessageZone = false; // Pour savoir si on est dans une zone active

        // Modèles pour l'animation ASCII
        const signalPatterns = {
            noSignal: [
                "     .     .     .     .     .     .     ",
                "     .     .     .     .     .     .     "
            ],
            lowSignal: [
                "~   ~    ~   ~    ~   ~    ~   ~",
                "   ~ ~      ~ ~      ~ ~      ~ ~",
                "~   ~    ~   ~    ~   ~    ~   ~"
            ],
            highSignal: [
                "~~ ~~~ ~~ ~~~ ~~ ~~~ ~~ ~~~ ~~ ~~~",
                " ~~~ ~~~ ~~~ ~~~ ~~~ ~~~ ~~~ ~~~ ",
                "~~ ~~~ ~~ ~~~ ~~ ~~~ ~~ ~~~ ~~ ~~~"
            ]
        };

        // Fonction pour démarrer l'animation de l'onde
        function startSignalAnimation(pattern) {
            clearInterval(animationInterval); // Arrêter l'animation précédente
            let index = 0;

            // Animation perturbée
            animationInterval = setInterval(() => {
                const perturbedPattern = pattern.map(line => addNoiseToLine(line));
                asciiSignalDiv.textContent = perturbedPattern.join("\n");
                index = (index + 1) % pattern.length;
            }, 15); // Vitesse de l'animation
        }

        // Ajouter du bruit aléatoire pour simuler un signal perturbé
        function addNoiseToLine(line) {
            const chars = ['...', '~~', '---', '***', ' '];
            return line.split("").map(char => {
                if (Math.random() > 0.9) { // 10% de chance de perturbation
                    return chars[Math.floor(Math.random() * chars.length)];
                }
                return char;
            }).join("");
        }

        function scrambleText(realText, duration = 2000) {
            const chars = "0# -*";
            let scrambled = '';
            let iteration = 0;

            const interval = setInterval(() => {
                scrambled = realText.split('').map((char, index) => {
                    if (index < iteration) return char;
                    return chars[Math.floor(Math.random() * chars.length)];
                }).join('');
                messageDiv.textContent = scrambled;

                if (iteration >= realText.length) clearInterval(interval);
                iteration++;
            }, duration / realText.length);
        }

        // Fonction pour démarrer l'animation ASCII des astérisques lorsque le message est actif
        function startMessageAnimation() {
            clearInterval(staticNoiseInterval); // Arrêter le bruit statique
            let index = 0;

            // Animation des astérisques
            messageInterval = setInterval(() => {
                const randomLine = generateRandomAsteriskLine();
                asciiSignalDiv.textContent = randomLine;
                index++;
            }, 100); // Intervalle de changement pour les astérisques
        }

        // Générer une ligne d'astérisques et espaces aléatoires
        function generateRandomAsteriskLine() {
            const lineLength = 50; // Longueur de la ligne
            let line = '';
            for (let i = 0; i < lineLength; i++) {
                const randomChar = Math.random() > 0.5 ? '*' : ' '; // Alternance entre astérisques et espaces
                line += randomChar;
            }
            return line;
        }

        // Fonction pour réactiver le bruit statique après la fin du message
        function stopMessageAnimation() {
            clearInterval(messageInterval); // Arrêter l'animation du message
            startStaticNoise(); // Réactiver le bruit statique
        }

        // Fonction pour maintenir l'animation de perturbation même pendant le signal
        function startStaticNoise() {
            clearInterval(staticNoiseInterval);
            staticNoiseInterval = setInterval(() => {
                // Perturber légèrement en continu
                const noisePattern = [
                    "     .     .     .     .     .     .     ",
                    "     .     .     .     .     .     .     "
                ];
                const perturbedNoise = noisePattern.map(line => addNoiseToLine(line));
                asciiSignalDiv.textContent = perturbedNoise.join("\n");
            }, 30); // Intervalle de perturbation statique
        }

        // Gestion du curseur
        slider.addEventListener('input', () => {
            const currentFrequency = parseFloat(slider.value).toFixed(1);
            frequencyDisplay.textContent = `Fréquence : ${currentFrequency} MHz`;
            messageDiv.textContent = "";

            let messageFound = false;
            isInMessageZone = false; // Réinitialiser l'état de zone

            frequencyZones.forEach(zone => {
                if (currentFrequency >= zone.min && currentFrequency <= zone.max) {
                    isInMessageZone = true;
                    if (currentMessage !== zone.text) {
                        currentMessage = zone.text; // Mémoriser le message actuel
                        scrambleText(zone.text);
                        startSignalAnimation(signalPatterns[zone.signalType]);
                        startMessageAnimation(); // Lancer l'animation des astérisques
                    }
                    messageFound = true;
                }
            });

            if (!messageFound) {
                if (isInMessageZone === false) {
                    currentMessage = null; // Réinitialiser le message lorsque l'on sort de la zone
                }
                startSignalAnimation(signalPatterns.noSignal);
                stopMessageAnimation(); // Arrêter l'animation des astérisques
            }

            // Toujours ajouter le bruit statique en arrière-plan
            if (!isInMessageZone) {
                startStaticNoise();
            }
        });

        // Initialiser avec aucun signal
        startSignalAnimation(signalPatterns.noSignal);
    </script>
</body>
</html>
