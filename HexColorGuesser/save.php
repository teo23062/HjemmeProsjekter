<?php
session_start();

include 'connection.php';

if (isset($_SESSION['brukernavn']) && isset($_POST['score'])) {
    $user_id = $_SESSION['brukernavn']; // Brukerens ID fra sesjonen
    $score = $_POST['score']; // Poengene fra klienten

    // Forbereder SQL-spørringen for å sette inn poengene i databasen
    $stmt = $mysqli->prepare("INSERT INTO leaderboard (bruekrnavn, poeng) VALUES (?, ?)");
    $stmt->bind_param('ii', $user_id, $score);

    // Utfører SQL-spørringen og sjekker om den var vellykket
    if ($stmt->execute()) {
        $response = ['message' => 'Poengene ble lagret vellykket'];
    } else {
        $response = ['error' => 'Feil ved lagring av poeng'];
    }

    $stmt->close(); // Lukker SQL-spørringen
} else {
    $response = ['error' => 'Uautorisert tilgang']; // Hvis brukeren ikke er logget inn eller poengene ikke ble sendt
}

header('Content-Type: application/json'); // Setter riktig MIME-type for JSON
echo json_encode($response); // Sender JSON-responsen til klienten
?>
