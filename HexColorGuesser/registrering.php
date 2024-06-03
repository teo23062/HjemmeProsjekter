<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Registrering</title>
</head>
<body>
    <form action="registrering.php" method="post">
        <input id="brukernavnReg" type="text" name="brukernavn" placeholder="Brukernavn" required><br>
        <input id="passordReg" type="password" name="passord" placeholder="Passord" required><br>
        <input id="epostReg" type="email" name="epost" placeholder="E-postadresse" required><br>
        <input id="regKnapp" type="submit" name="register" value="Registrer">
        <p id="tilbakeKnapp"><a href="index.php">Tilbake til hovedside</a></p>
    </form>
</body>
</html>

<?php
session_start();

include 'connection.php';

if (isset($_POST['register'])) {
    $brukernavn = $_POST["brukernavn"];
    $passord = $_POST["passord"];
    $epost = $_POST["epost"];

    $hash = password_hash($passord, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO hex_bruker (brukernavn, passord, epost) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $brukernavn, $hash, $epost);

    if ($stmt->execute()) {
        echo "<p>Registrering vellykket</p>";
        header("Location: login.php");
    } else {
        echo "<p>Noe gikk galt. Vennligst prøv igjen senere.</p>";
    }

    $stmt->close();
}
?>
