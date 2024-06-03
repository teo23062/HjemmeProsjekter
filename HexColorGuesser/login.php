<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Logg inn</title>
</head>
<body>
    <form action="login.php" method="post">
        <input id="brukernavnInput" type="text" name="brukernavn" placeholder="Brukernavn" required><br>
        <input id="passordInput" type="password" name="passord" placeholder="Passord" required><br>
        <input id="logginknapp" type="submit" name="login" value="Logg inn">

        <p id="registrerHer">Har du ikke bruker? <a href="registrering.php">Registrer her!</a></p>
        <p id="tilbakeKnapp"><a href="index.php">Tilbake til hovedside</a></p>
    </form>
</body>
</html>

<?php

session_start();

include 'connection.php';

if (isset($_POST['login'])) {
    $loggetinn = False;

    $brukernavn = $_POST["brukernavn"];
    $passord = $_POST["passord"];

    $stmt = $mysqli->prepare("SELECT passord FROM hex_bruker WHERE brukernavn = ?");
    $stmt->bind_param('s', $brukernavn);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $lagret_passord = $row['passord'];

        if (password_verify($passord, $lagret_passord)) {
            $_SESSION["brukernavn"] = $brukernavn;
            echo "Brukeren er logget inn.";
            header("Location: index.php");
            $_SESSION["loggetinn"] = true;
            exit();
        } else {
            echo "<p>Feil passord.</p>";
            echo "Passord verifikasjon feilet.";
        }

    } else {
        echo "<p>Ugyldig brukernavn.</p>";
    }

    $stmt->close();
}
?>
