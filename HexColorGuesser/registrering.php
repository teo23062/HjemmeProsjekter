<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrering</title>
</head>
<body>
    <h2>Registreringsskjema</h2>
    <form action="registrering.php" method="post">
        <input type="text" name="brukernavn" placeholder="Brukernavn" required><br>
        <input type="password" name="passord" placeholder="Passord" required><br>
        <input type="email" name="epost" placeholder="E-postadresse" required><br>
        <input type="submit" name="register" value="Registrer">
    </form>
</body>
</html>

<?php
// Dette er registreringsskriptet (registrering.php)

// Starter en PHP-sesjon
session_start();

// Inkluderer filen for databasekobling
include 'connection.php';

// Sjekker om skjemaet er sendt
if (isset($_POST['register'])) {
    // Henter brukernavn, passord og e-postadresse fra skjemaet
    $brukernavn = $_POST["brukernavn"];
    $passord = $_POST["passord"];
    $epost = $_POST["epost"];

    // Hasher passordet
    $hash = password_hash($passord, PASSWORD_DEFAULT);

    // Forbereder SQL-spørringen
    $stmt = $mysqli->prepare("INSERT INTO bruker (brukernavn, passord, epost) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $brukernavn, $hash, $epost);

    // Utfører SQL-spørringen
    if ($stmt->execute()) {
        echo "<p>Registrering vellykket. Logg inn <a href='login.php'>her</a>.</p>";
    } else {
        echo "<p>Noe gikk galt. Vennligst prøv igjen senere.</p>";
    }

    // Lukker SQL-spørringen
    $stmt->close();
}
?>
