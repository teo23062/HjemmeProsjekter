<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Random Hex Color</title>
</head>
<body>
    <?php
    if (isset($_SESSION["loggetinn"]) && $_SESSION["loggetinn"] === true) {
        $buttonName = "<a href='logut.php'>Logg ut</a>";
    } else {
        $buttonName = "<a href='login.php'>Logg inn</a>";
    }
    ?>

    <button id="loginbutton"><?php echo $buttonName; ?></button>
    <p><?php echo "<p>Du er logget inn som " . $_SESSION["brukernavn"] . ".</p>"?></p>

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

<script>
var hexColor;
var clicks = 0;
var score = 11;
var closestDifference = Infinity;
var closestGuess = null;

function generateRandomColor() {
    score = 11;
    var red = Math.floor(Math.random() * 256);
    var green = Math.floor(Math.random() * 256);
    var blue = Math.floor(Math.random() * 256);

    hexColor = "#" + componentToHex(red) + componentToHex(green) + componentToHex(blue);
    
    document.getElementById("guessButton").textContent = "Guess";
    document.getElementById("guessButton").disabled = false;
    clicks = 0;
    document.getElementById("colorDisplay").style.backgroundColor = hexColor;
    document.getElementById("guessedHex").style.display = "initial";
    document.getElementById("guessedHex").value = "";
    document.getElementById("closests").innerHTML = "";
    document.getElementById("help").innerHTML = "";
    document.getElementById("guessedColorDisplay").innerHTML = "";
    console.log("Color: " + hexColor);

    closestDifference = Infinity;
    closestGuess = null;
    return hexColor;
}

function guessHex() {
    if (!hexColor) {
        console.error("Hex color is undefined. Generate a random color first.");
        return;
    }

    clicks++;
    console.log(clicks);

    if (clicks == 10) {
        document.getElementById("guessButton").disabled = true;
        document.getElementById("guessButton").textContent = "← Try again";
    }

    var guessedHexValue = document.getElementById("guessedHex").value;
    if (!guessedHexValue.startsWith("#")) {
        guessedHexValue = "#" + guessedHexValue;
    }
    console.log("Guessed Hex Value: " + guessedHexValue);
    console.log("Hex Color: " + hexColor);

    var outputElement = document.getElementById("guessedColorDisplay");
    if (!outputElement) {
        console.error("Output element not found.");
        return;
    }

    var guessedInt = parseInt(guessedHexValue.substring(1), 16);
    var hexInt = parseInt(hexColor.substring(1), 16);
    var difference = Math.abs(guessedInt - hexInt);

    console.log("Difference: " + difference);
    console.log("Closest difference: " + closestDifference);

    if (difference < closestDifference) {
        closestGuess = guessedHexValue;
        closestDifference = difference;
    }

    var closestGuessSpan = document.createElement("span");
    closestGuessSpan.textContent = closestGuess;
    closestGuessSpan.style.color = closestGuess;

    var closestsElement = document.getElementById("closests");
    closestsElement.innerHTML = "";
    closestsElement.appendChild(closestGuessSpan);

    compareCharacters(hexColor, closestGuess);

    if (guessedHexValue.toLowerCase() === hexColor.toLowerCase()) {
    console.log("Final score: " + score);
    console.log("Correct");
    document.getElementById("guessButton").disabled = true;

    // Send score data to the server
    fetch('save.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            score: score
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log(data.message); // Log response from the server
    })
    .catch(error => console.error('Error saving score:', error));
    document.getElementById("guessButton").disabled = true;

    var newTextSpan = document.createElement("span");
    newTextSpan.textContent = "Score: " + score + "\n";
    newTextSpan.style.color = "green";

    outputElement.appendChild(newTextSpan);
} else {
    console.log("Wrong!");
    score--;
    console.log("Score: " + score);

    var guessSpan = document.createElement("span");
    guessSpan.textContent = guessedHexValue + "\n";
    guessSpan.style.color = guessedHexValue;

    outputElement.appendChild(guessSpan);
}
    compareCharacters(hexColor, guessedHexValue);
}

function compareCharacters(hexColor, closestGuess) {
    var helpDiv = document.getElementById('help');
    helpDiv.innerHTML = '';

    if (closestGuess && closestGuess.length === 7) {
        var hashDiv = document.createElement('div');
        hashDiv.textContent = "#";
        hashDiv.className = 'charDiv';
        helpDiv.appendChild(hashDiv);

        var indexes = [1, 3, 5];

        for (var i = 0; i < indexes.length; i++) {
            var pairIndex = indexes[i];
            var guessPair = closestGuess.slice(pairIndex, pairIndex + 2);
            var hexPair = hexColor.slice(pairIndex, pairIndex + 2);

            var charContainer = document.createElement('div');
            charContainer.className = 'charContainer';

            for (var j = 0; j < 2; j++) {
                var charIndex = pairIndex + j;
                var charDiv = document.createElement('div');
                charDiv.textContent = closestGuess[charIndex];
                charDiv.id = "charDiv_" + charIndex;
                charDiv.className = 'charDiv';

                if (closestGuess[charIndex] === hexColor[charIndex]) {
                    charDiv.classList.add('correct');
                } else {
                    charDiv.classList.add('incorrect');
                }

                charContainer.appendChild(charDiv);
            }

            if (parseInt(hexPair, 16) > parseInt(guessPair, 16)) {
                var caretDiv = document.createElement('div');
                caretDiv.textContent = "↑";
                caretDiv.className = 'caret above';
                charContainer.appendChild(caretDiv);
            } else if (parseInt(hexPair, 16) < parseInt(guessPair, 16)) {
                var caretDiv = document.createElement('div');
                caretDiv.textContent = "↓";
                caretDiv.className = 'caret below';
                charContainer.appendChild(caretDiv);
            }

            helpDiv.appendChild(charContainer);

            if (i === 0 || i === 1) {
                charContainer.style.marginRight = "13px";
            }
        }
    }
}
function componentToHex(c) {
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}
</script>
</body>
</html>