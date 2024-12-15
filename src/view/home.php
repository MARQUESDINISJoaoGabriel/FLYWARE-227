<?php
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $user_ip = $_SERVER['REMOTE_ADDR'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FLYWARE-227</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color:rgb(0, 0, 0);
            color: #e0e0e0;
            text-align: center;
        }
        a {
            text-decoration: none;
            color: #00ffcc;
            font-size: 1.5rem;
            margin: 20px;
            display: block;
        }
        a:hover {
            color:rgb(28, 177, 147);
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
    <h1>FLYWARE-227</h1>
    <p>SESSION DEMAREE - BIENVENUE [<?php echo $user_ip; ?>]</p>
    <a href="Router.php?page=radio">[RADIO]</a>
    <a href="Router.php?page=logbook">[LOGS]</a>
    <div id="static-noiseEFFECT" class="static-noiseEFFECT"></div>
    
</body>
</html>
