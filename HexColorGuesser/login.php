<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logg inn</title>
</head>
<body>
    <h2>Logg inn</h2>
    <form action="login.php" method="post">
        <input type="text" name="brukernavn" placeholder="Brukernavn" required><br>
        <input type="password" name="passord" placeholder="Passord" required><br>
        <input type="submit" name="login" value="Logg inn">
    </form>
</body>
</html>

<?php
// Dette er innloggingsskriptet (login.php)

// Starter en PHP-sesjon
session_start();

// Inkluderer filen for databasekobling
include 'connection.php';

// Sjekker om skjemaet er sendt
if (isset($_POST['login'])) {
    // Henter brukernavn og passord fra skjemaet
    $brukernavn = $_POST["brukernavn"];
    $passord = $_POST["passord"];

    // Forbereder SQL-spørringen
    $stmt = $mysqli->prepare("SELECT passord FROM bruker WHERE brukernavn = ?");
    $stmt->bind_param('s', $brukernavn);

    // Utfører SQL-spørringen
    $stmt->execute();
    $result = $stmt->get_result();

    // Sjekker om brukeren ble funnet
    if ($result->num_rows == 1) {
        // Henter passordet fra resultatet
        // Henter passordet fra resultatet
        $row = $result->fetch_assoc();
        $lagret_passord = $row['passord'];

        // Utskrift for det hashede passordet som er lagret i databasen
        echo "Lagret passord i databasen: " . $lagret_passord . "<br>";

        // Utskrift for det passordet som er skrevet inn i skjemaet
        echo "Passord skrevet inn i skjemaet: " . $passord . "<br>";

        // Sjekker om passordet stemmer
        if (password_verify($passord, $lagret_passord)) {
            // Passordet er riktig, logg inn brukeren
            $_SESSION["brukernavn"] = $brukernavn;
            echo "Brukeren er logget inn."; // Midlertidig utskrift for feilsøking
            header("Location: index.php");
            exit();
        } else {
            // Feil passord
            echo "<p>Feil passord.</p>";
        }

    } else {
        // Brukeren ble ikke funnet
        echo "<p>Ugyldig brukernavn.</p>";
    }

    // Lukker SQL-spørringen
    $stmt->close();
}
?>
