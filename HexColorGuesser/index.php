<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Hex Color</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <h1 id="Heading">Random Hex Color</h1>
    <div id="ButtonAndHexBox">
        <h3>Your random color is...</h3>
        <div id="colorDisplay"></div>
        <input placeholder="Guess here: " id="guessedHex" maxlength="7"><br>
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
        <div id="help"></div>
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

            return hexColor;
        }

        function guessHex() {
            if (!hexColor) {
                console.error("Hex color is undefined. Generate a random color first.");
                return;
            }

            clicks++;
            console.log(clicks);

            //Sjekker om man har klikket ti ganger eller ikke
            if (clicks == 10) {
                document.getElementById("guessButton").disabled = true;
                document.getElementById("guessButton").textContent = "<<<< Try again";
            } else {
                document.getElementById("guessButton").disabled = false;
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

            //Sjekker nærmeste hex color gjettet
            var guessedInt = parseInt(guessedHexValue.substring(1), 16);
            var hexInt = parseInt(hexColor.substring(1), 16);
            var difference = Math.abs(guessedInt - hexInt);

            console.log("Difference: " + difference);
            console.log("Closest difference: " + closestDifference);

            if (difference < closestDifference) {
            closestGuess = guessedHexValue;
            closestDifference = difference;
            
            var closestGuessSpan = document.createElement("span");
            closestGuessSpan.textContent = closestGuess + "\n";
            closestGuessSpan.style.color = guessedHexValue;

            var closestsElement = document.getElementById("closests");
            closestsElement.innerHTML = "";
            closestsElement.appendChild(closestGuessSpan);

            for (var i = 0; i < closestGuess.length; i++) {
                var digitSpan = document.createElement("span");
                digitSpan.textContent = closestGuess[i];
                digitSpan.style.color = guessedHexValue;
            }

        }



            var helpDiv = document.getElementById('help');
            helpDiv.innerHTML = '';

            var inputValue = closestGuess;

            if (inputValue) {
                for (var i = 0; i < inputValue.length; i++) {
                    var charDiv = document.createElement('div');
                    charDiv.textContent = inputValue[i];
                    charDiv.id = "charDiv_" + i;
                    helpDiv.appendChild(charDiv);
                }
            }


            

            //Sjekker om man har riktig eller ikke
            if (guessedHexValue.toLowerCase() === hexColor.toLowerCase()) {
                console.log("Final score: " + score);
                console.log("Correct");
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
        }

        function componentToHex(c) {
            var hex = c.toString(16);
            return hex.length == 1 ? "0" + hex : hex;
        }

    </script>
</body>
</html>
