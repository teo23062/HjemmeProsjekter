<?php
// Funksjon for å opprette en tilkobling til databasen
function getDatabaseConnection() {
    // Oppretter en ny MySQLi-tilkobling
    $mysqli = new mysqli("localhost", "root", "", "hex_color_guesser");

    // Sjekker om tilkoblingen feiler
    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }

    // Setter tegnsettet til UTF-8
    if (!$mysqli->set_charset("utf8")) {
        // Logger feilmeldingen for intern bruk og viser en generell feilmelding til brukeren
        error_log("Failed to set charset: " . $mysqli->error);
        echo "Sorry, we are experiencing technical difficulties. Please try again later.";
        exit(); // Avslutter skriptet
    }

    return $mysqli; // Returnerer tilkoblingsobjektet
}

// Bruker funksjonen for å få databaseforbindelsen
$mysqli = getDatabaseConnection();
?>
