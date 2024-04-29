<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <h1 id="Overskrift">Tilfedlig Hex Kode</h1>
    <div id="KnappogHexBoks">
        <h3>Din tilfedlige farge er...</h3>
        <div id="colorDisplay"></div>
        <input placeholder="Gjett her: " id="hexcodegjettet" maxlength="7"><br>
        <button onclick="generateRandomColor(clicks)" id="genererHex">Generer Tilfeldig</button>
        <button onclick="gjettHex(hexColor, clicks)" id="gjettknapp">Gjett</button>
    </div>

    <div id="tidligereForsok">
        <p class="tidligereforsoktekst">Dine tidligere forsøk:</p>
        <div id="hexcolorgjett">

        </div>
    </div>

    <script>
        var hexColor;

        var clicks = 0;
        function generateRandomColor() {
            var red = Math.floor(Math.random() * 256);
            var green = Math.floor(Math.random() * 256);
            var blue = Math.floor(Math.random() * 256);

            hexColor = "#" + componentToHex(red) + componentToHex(green) + componentToHex(blue);

            document.getElementById("gjettknapp").disabled = false;
            clicks = 0;
            document.getElementById("colorDisplay").style.backgroundColor = hexColor;
            document.getElementById("hexcodegjettet").style.display = "initial";
            document.getElementById("hexcodegjettet").value = "";
            document.getElementById("hexcolorgjett").innerHTML = "";
            console.log(hexColor);

            return hexColor;
        }

        function gjettHex() {
            clicks++;
            console.log(clicks);
            if(clicks == 10) {
                document.getElementById("gjettknapp").disabled = true;
            }else {
                document.getElementById("gjettknapp").disabled = false;
            }
            var hexgjettet = document.getElementById("hexcodegjettet");
            var hexgjettetValue = hexgjettet.value;

            if (hexgjettetValue.toLowerCase() === hexColor.toLowerCase()) {
                console.log("Korrekt");
                document.getElementById("gjettknapp").disabled = true;

                var outputElement = document.getElementById("hexcolorgjett");

                var newTextSpan = document.createElement("span");
                newTextSpan.textContent = hexgjettetValue + "\n";
                newTextSpan.style.color = "green";

                outputElement.appendChild(newTextSpan);
            } else {
                console.log("Feil!");

                var outputElement = document.getElementById("hexcolorgjett");
                outputElement.textContent += hexgjettetValue + "\n";
                outputElement.style.color = "red";
            }
        }

        function handleGjettButton() {
            generateRandomColor();
            gjettHex();

            if (hexgjettetValue.toLowerCase() === hexColor.toLowerCase()) {
                document.getElementById("hexcolorgjett").value = "";
            }
        }

        function componentToHex(c) {
            var hex = c.toString(16);
            return hex.length == 1 ? "0" + hex : hex;
        }

    </script>
</body>
</html>