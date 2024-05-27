<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Random Hex Color</title>
</head>
<body>
    <h1 id="Heading">Random Hex Color</h1>
    <div id="ButtonAndHexBox">
        <h3>Your random color is...</h3>
        <div id="colorDisplay"></div> 
        <div class="input-container">
            <div class="hash-box">#</div>
            <input class="guess-input" placeholder="Guess here: " id="guessedHex" minlength="6" maxlength="6">
        </div>
        <button onclick="generateRandomColor()" id="generateHex">Generate Random</button>
        <button onclick="guessHex()" id="guessButton">Guess</button>
    </div>

    <div id="closestAttempt">
        <p class="closestAttemptText">Closest attempt</p>
        <div id="closests"></div>
    </div>

    <div id="previousAttempts">
        <p class="previousAttemptText">Your previous attempts:</p>
        <div id="guessedColorDisplay"></div>
    </div>

    <div id="helpBox">
        <div id="pluss"></div>
        <div id="help"></div>
        <div id="minus"></div>
    </div>

    <script src="script.js"></script></body>
</body>
</html>