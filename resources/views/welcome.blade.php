<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotería Ganadora</title>
    <style>
        body {
            text-align: center;
            padding: 50px;
        }
    </style>
</head>
<body>
    <h1>¡Felicitaciones, has ganado!</h1>
    <audio id="victorySound" src="path/to/your/sound.mp3"></audio>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js"></script>
    <script>
        window.onload = function() {
            document.getElementById('victorySound').play();
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 }
            });
        };
    </script>
</body>
</html>