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
        <input placeholder="Gjett her: " id="hexcodegjettet"><br>
        <button onclick="generateRandomColor()" id="genererHex">Generer Tilfeldig</button>
        <button onclick="gjettHex()" id="gjettHex">Gjett</button>
    </div>

    <div id="tidligereForsok">
        <p class="tidligereforsoktekst">Dine tidligere forsøk:</p>
        <div id="hexcolorgjett">

        </div>
    </div>

    <script>
        function generateRandomColor() {
            var red = Math.floor(Math.random() * 256);
            var green = Math.floor(Math.random() * 256);
            var blue = Math.floor(Math.random() * 256);

            var hexColor = "#" + componentToHex(red) + componentToHex(green) + componentToHex(blue);

            document.getElementById("colorDisplay").style.backgroundColor = hexColor;
            document.getElementById("hexcodegjettet").style.display = "initial";
            document.getElementById("hexcodegjettet").value = "";
        }

        function gjettHex() {
            var hexgjettet = document.getElementById("hexcodegjettet");
            var hexgjettetValue = hexgjettet.value;

            var outputElement = document.getElementById("hexcolorgjett");
            outputElement.textContent += hexgjettetValue + "\n";
        }

        function componentToHex(c) {
            var hex = c.toString(16);
            return hex.length == 1 ? "0" + hex : hex;
        }
    </script>
</body>
</html>